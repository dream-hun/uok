<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use OpenAI\Contracts\ClientContract;
use OpenAI\Exceptions\RateLimitException;

final readonly class RentalChatService
{
    public function __construct(private ClientContract $client) {}

    public function answer(string $question, array $filters = []): array
    {
        $properties = $this->queryProperties($filters);

        $prompt = $this->buildPrompt($question, $properties, $filters);

        $model = config('services.openai.rental_model', 'gpt-4o-mini');

        try {
            $response = $this->client->chat()->create([
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a housing assistant. Base all answers strictly on the supplied property data. Highlight commute times and infrastructure facts when possible.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
            ]);
        } catch (RateLimitException $rateLimitException) {
            report($rateLimitException);

            return $this->buildResponse(
                'We are temporarily hitting our AI rate limits. Please try again in a moment.',
                $properties,
                ['error' => 'rate_limit']
            );
        }

        $answer = data_get($response, 'choices.0.message.content', 'Sorry, I could not generate a response.');

        return $this->buildResponse($answer, $properties);
    }

    private function queryProperties(array $filters): Collection
    {
        $query = Property::with(['infrastructures'])
            ->when($filters['city'] ?? null, fn ($q, $city) => $q->where('city', $city))
            ->when($filters['state'] ?? null, fn ($q, $state) => $q->where('state', $state))
            ->when($filters['max_rent'] ?? null, fn ($q, $max) => $q->where('rent_per_month', '<=', (int) $max))
            ->when($filters['min_bedrooms'] ?? null, fn ($q, $min) => $q->where('bedrooms', '>=', (int) $min))
            ->orderBy('rent_per_month')
            ->limit($filters['limit'] ?? 5);

        $properties = $query->get();

        if ($properties->isEmpty()) {
            return Property::with('infrastructures')
                ->orderBy('rent_per_month')
                ->limit(3)
                ->get();
        }

        return $properties;
    }

    private function buildPrompt(string $question, Collection $properties, array $filters): string
    {
        if ($properties->isEmpty()) {
            return "Question: {$question}\nNo properties are currently available in the database.";
        }

        $location = mb_trim(($filters['city'] ?? '').' '.($filters['state'] ?? ''));

        $summary = $properties->map(function (Property $property) {
            $infraSummary = $property->infrastructures
                ->map(function ($infrastructure): string {
                    $distance = $infrastructure->pivot->distance_meters
                        ? ($infrastructure->pivot->distance_meters / 1000).' km'
                        : 'distance n/a';

                    $travel = $infrastructure->pivot->travel_time_minutes
                        ? $infrastructure->pivot->travel_time_minutes.' min'
                        : 'time n/a';

                    return sprintf('%s: %s (%s, %s via %s)', $infrastructure->category, $infrastructure->name, $distance, $travel, $infrastructure->pivot->travel_mode);
                })
                ->implode('; ');

            return Str::of('')
                ->append(sprintf('Property #%s: %s%s', $property->id, $property->title, PHP_EOL))
                ->append(sprintf('Location: %s, %s%s', $property->city, $property->state, PHP_EOL))
                ->append("Rent: {$property->rent_per_month} per month | {$property->bedrooms} bed / {$property->bathrooms} bath\n")
                ->append('Available: '.$property->available_on?->toDateString()."\n")
                ->append('Features: '.implode(', ', $property->features ?? [])."\n")
                ->append(sprintf('Nearby: %s%s', $infraSummary, PHP_EOL));
        })->implode("\n---\n");

        return mb_trim("
Question: {$question}
Location filter: ".($location ?: 'not specified').'
Max rent: '.($filters['max_rent'] ?? 'not specified')."

Available properties:
{$summary}

Instructions:
- Answer conversationally.
- Reference property IDs when making recommendations.
- Mention commute distances/time when relevant.
");
    }

    private function buildResponse(string $answer, Collection $properties, array $extra = []): array
    {
        return array_merge([
            'answer' => $answer,
            'properties' => $this->formatProperties($properties),
        ], $extra);
    }

    private function formatProperties(Collection $properties): Collection
    {
        return $properties->map(fn (Property $property): array => [
            'id' => $property->id,
            'slug' => $property->slug,
            'title' => $property->title,
            'rent_per_month' => $property->rent_per_month,
            'city' => $property->city,
            'state' => $property->state,
            'bedrooms' => $property->bedrooms,
            'bathrooms' => $property->bathrooms,
            'available_on' => $property->available_on?->toDateString(),
            'infrastructures' => $property->infrastructures->map(fn($infrastructure): array => [
                'name' => $infrastructure->name,
                'category' => $infrastructure->category,
                'distance_meters' => $infrastructure->pivot->distance_meters,
                'travel_time_minutes' => $infrastructure->pivot->travel_time_minutes,
                'travel_mode' => $infrastructure->pivot->travel_mode,
            ]),
        ]);
    }
}

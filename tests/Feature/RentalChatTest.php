<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Infrastructure;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use OpenAI\Contracts\ClientContract;
use OpenAI\Contracts\Resources\ChatContract;
use OpenAI\Exceptions\RateLimitException;
use OpenAI\Responses\Chat\CreateResponse;
use Psr\Http\Message\ResponseInterface;
use Tests\TestCase;

final class RentalChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_gpt_answer_with_property_context(): void
    {
        $client = Mockery::mock(ClientContract::class);
        $chat = Mockery::mock(ChatContract::class);

        $client->shouldReceive('chat')->once()->andReturn($chat);
        $chat->shouldReceive('create')->once()->andReturn(
            CreateResponse::fake([
                'choices' => [
                    [
                        'index' => 0,
                        'message' => [
                            'role' => 'assistant',
                            'content' => 'Mocked answer about rentals.',
                        ],
                        'logprobs' => null,
                        'finish_reason' => 'stop',
                    ],
                ],
            ])
        );

        $this->app->instance(ClientContract::class, $client);

        $property = Property::factory()->create([
            'city' => 'Seattle',
            'state' => 'WA',
            'rent_per_month' => 2500,
            'bedrooms' => 2,
        ]);

        $infrastructure = Infrastructure::factory()->create([
            'city' => 'Seattle',
            'category' => 'transit',
        ]);

        $property->infrastructures()->attach($infrastructure->id, [
            'distance_meters' => 500,
            'travel_time_minutes' => 5,
            'travel_mode' => 'walk',
        ]);

        $payload = [
            'question' => 'Do you have a 2 bedroom near Seattle transit?',
            'city' => 'Seattle',
            'state' => 'WA',
            'max_rent' => 3000,
            'min_bedrooms' => 2,
        ];

        $response = $this->postJson('/api/rental-chat', $payload);

        $response->assertOk()
            ->assertJsonPath('data.answer', 'Mocked answer about rentals.')
            ->assertJsonPath('data.properties.0.slug', $property->slug)
            ->assertJsonPath('data.properties.0.city', 'Seattle')
            ->assertJsonPath('data.properties.0.infrastructures.0.category', 'transit');
    }

    public function test_it_returns_friendly_message_on_rate_limit(): void
    {
        $client = Mockery::mock(ClientContract::class);
        $chat = Mockery::mock(ChatContract::class);
        $response = Mockery::mock(ResponseInterface::class);

        $client->shouldReceive('chat')->once()->andReturn($chat);
        $chat->shouldReceive('create')->once()->andThrow(new RateLimitException($response));

        $this->app->instance(ClientContract::class, $client);

        Property::factory()->create();

        $payload = [
            'question' => 'Need any apartment info?',
        ];

        $response = $this->postJson('/api/rental-chat', $payload);

        $response->assertOk()
            ->assertJsonPath('data.error', 'rate_limit')
            ->assertJsonFragment([
                'answer' => 'We are temporarily hitting our AI rate limits. Please try again in a moment.',
            ]);
    }
}

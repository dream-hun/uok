<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Infrastructure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Infrastructure>
 */
final class InfrastructureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['transit', 'school', 'hospital', 'shopping', 'park', 'coworking'];
        $category = fake()->randomElement($categories);

        return [
            'name' => match ($category) {
                'transit' => fake()->randomElement(['Metro Station', 'Bus Hub', 'Light Rail Stop']).' '.fake()->streetSuffix(),
                'school' => fake()->randomElement(['Public School', 'STEM Academy', 'Community College']).' '.fake()->streetSuffix(),
                'hospital' => fake()->company().' Medical Center',
                'shopping' => fake()->company().' Plaza',
                'park' => fake()->lastName().' Park',
                'coworking' => fake()->company().' Cowork',
                default => fake()->company().' Hub',
            },
            'category' => $category,
            'description' => fake()->sentence(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'metadata' => [
                'hours' => fake()->randomElement(['24/7', '6am-11pm', 'Business hours']),
                'contact' => fake()->phoneNumber(),
            ],
        ];
    }
}

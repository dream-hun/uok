<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Property>
 */
final class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->streetName().' Residence';

        return [
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->unique()->numberBetween(100, 999)),
            'description' => fake()->paragraph(),
            'address_line1' => fake()->streetAddress(),
            'address_line2' => fake()->optional()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'postal_code' => fake()->postcode(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'bedrooms' => fake()->numberBetween(1, 5),
            'bathrooms' => fake()->randomFloat(1, 1, 3),
            'square_feet' => fake()->numberBetween(600, 2500),
            'rent_per_month' => fake()->numberBetween(800, 5000),
            'security_deposit' => fake()->numberBetween(500, 3000),
            'pets_allowed' => fake()->boolean(),
            'available_on' => fake()->dateTimeBetween('now', '+3 months'),
            'features' => fake()->randomElements([
                'gym',
                'pool',
                'parking',
                '24-7 security',
                'coworking space',
                'rooftop',
            ], fake()->numberBetween(1, 3)),
        ];
    }
}

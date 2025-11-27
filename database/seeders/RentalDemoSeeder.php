<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Infrastructure;
use App\Models\Property;
use Illuminate\Database\Seeder;

final class RentalDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $infrastructures = Infrastructure::factory(30)->create();

        Property::factory(20)
            ->create()
            ->each(function (Property $property) use ($infrastructures): void {
                $selection = $infrastructures->random(random_int(3, 6));

                foreach ($selection as $infrastructure) {
                    $property->infrastructures()->attach($infrastructure->id, [
                        'distance_meters' => fake()->numberBetween(100, 5000),
                        'travel_time_minutes' => fake()->numberBetween(1, 45),
                        'travel_mode' => fake()->randomElement(['walk', 'bike', 'drive', 'transit']),
                        'notes' => fake()->optional()->sentence(),
                    ]);
                }
            });
    }
}

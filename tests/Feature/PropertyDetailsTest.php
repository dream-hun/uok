<?php

declare(strict_types=1);

use App\Models\Infrastructure;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows property details with nearby infrastructure', function (): void {
    $property = Property::factory()->create([
        'title' => 'Beacon Hill Loft',
        'rent_per_month' => 2850,
        'city' => 'Seattle',
        'state' => 'WA',
        'available_on' => now()->addWeek(),
    ]);

    $infrastructure = Infrastructure::factory()->create([
        'name' => 'Beacon Hill Station',
        'category' => 'transit',
    ]);

    $property->infrastructures()->attach($infrastructure->id, [
        'distance_meters' => 750,
        'travel_time_minutes' => 8,
        'travel_mode' => 'walk',
        'notes' => 'One stop to downtown',
    ]);

    $response = $this->get(route('properties.show', $property->slug));

    $response->assertOk()
        ->assertSeeText('Beacon Hill Loft')
        ->assertSeeText('$2,850')
        ->assertSeeText('Beacon Hill Station')
        ->assertSeeText('walk');
});

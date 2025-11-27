<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Property extends Model
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'rent_per_month',
        'security_deposit',
        'pets_allowed',
        'available_on',
        'features',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'bathrooms' => 'float',
        'available_on' => 'date',
        'pets_allowed' => 'boolean',
        'features' => 'array',
    ];

    public function infrastructures()
    {
        return $this->belongsToMany(Infrastructure::class)
            ->withPivot(['distance_meters', 'travel_time_minutes', 'travel_mode', 'notes'])
            ->withTimestamps();
    }

    #[Scope]
    protected function locatedIn($query, ?string $city = null, ?string $state = null)
    {
        return $query
            ->when($city, fn ($q) => $q->where('city', $city))
            ->when($state, fn ($q) => $q->where('state', $state));
    }

    #[Scope]
    protected function maxRent($query, ?int $amount)
    {
        return $query->when($amount, fn ($q) => $q->where('rent_per_month', '<=', $amount));
    }

    #[Scope]
    protected function minBedrooms($query, ?int $min)
    {
        return $query->when($min, fn ($q) => $q->where('bedrooms', '>=', $min));
    }
}

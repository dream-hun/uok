<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\InfrastructureFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Infrastructure extends Model
{
    /** @use HasFactory<InfrastructureFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'address',
        'city',
        'latitude',
        'longitude',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'metadata' => 'array',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->withPivot(['distance_meters', 'travel_time_minutes', 'travel_mode', 'notes'])
            ->withTimestamps();
    }
}

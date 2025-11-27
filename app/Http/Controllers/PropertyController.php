<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;

final class PropertyController extends Controller
{
    public function show(Property $property): View
    {
        $property->loadMissing('infrastructures');

        return view('properties.show', [
            'property' => $property,
        ]);
    }
}

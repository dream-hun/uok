<?php

declare(strict_types=1);

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RentalChatPageController;
use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): Factory|View => view('welcome', ['properties' => Property::query()->limit(9)->get()]));

Route::get('/rental-chat', [RentalChatPageController::class, 'create'])
    ->name('rental-chat.create');

Route::post('/rental-chat', [RentalChatPageController::class, 'store'])
    ->name('rental-chat.store');

Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])
    ->name('properties.show');

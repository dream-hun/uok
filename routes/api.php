<?php

declare(strict_types=1);

use App\Http\Controllers\RentalChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function (): void {
    Route::post('/rental-chat', RentalChatController::class)
        ->name('api.rental-chat');
});

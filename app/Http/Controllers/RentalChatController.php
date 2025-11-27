<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RentalChatRequest;
use App\Services\RentalChatService;

final class RentalChatController extends Controller
{
    public function __invoke(RentalChatRequest $request, RentalChatService $rentalChat)
    {
        $result = $rentalChat->answer($request->question(), $request->filters());

        return response()->json([
            'data' => $result,
        ]);
    }
}

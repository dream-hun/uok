<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RentalChatRequest;
use App\Services\RentalChatService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class RentalChatPageController extends Controller
{
    public function create(): View
    {
        return view('rental-chat', [
            'result' => session()->pull('result'),
        ]);
    }

    public function store(RentalChatRequest $request, RentalChatService $rentalChat): RedirectResponse
    {
        $result = $rentalChat->answer($request->question(), $request->filters());

        return to_route('rental-chat.create')
            ->withInput()
            ->with('result', $result);
    }
}

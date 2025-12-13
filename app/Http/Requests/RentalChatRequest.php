<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class RentalChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'min:5'],
            'city' => ['nullable', 'string', 'max:150'],
            'state' => ['nullable', 'string', 'max:150'],
            'max_rent' => ['nullable', 'integer', 'min:0'],
            'min_bedrooms' => ['nullable', 'integer', 'min:0'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function question(): string
    {
        return (string) $this->validated('question');
    }

    public function filters(): array
    {
        return collect($this->safe()->except('question'))
            ->reject(fn ($value): bool => $value === null || $value === '')
            ->map(fn ($value, string $key) => in_array($key, ['max_rent', 'min_bedrooms', 'limit'], true)
                ? (int) $value
                : $value)
            ->all();
    }
}

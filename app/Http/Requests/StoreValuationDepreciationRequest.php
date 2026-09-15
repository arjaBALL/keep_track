<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValuationDepreciationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'estimated_life' => ['required', 'integer'],
            'unit_value' => ['required', 'numeric'],
            'salvage_value' => ['required', 'numeric'],
            'monthly_depreciation' => ['required', 'numeric'],
            'month_id' => ['required', 'integer'],
            'accumulated_depreciation' => ['required', 'numeric'],
            'net_book_value' => ['required', 'numeric'],
        ];
    }
}

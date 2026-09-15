<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateValuationDepreciationRequest extends FormRequest
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
            'estimated_life' => ['sometimes', 'integer'],
            'unit_value' => ['sometimes', 'numeric'],
            'salvage_value' => ['sometimes', 'numeric'],
            'monthly_depreciation' => ['sometimes', 'numeric'],
            'month_id' => ['sometimes', 'integer'],
            'accumulated_depreciation' => ['sometimes', 'numeric'],
            'net_book_value' => ['sometimes', 'numeric'],
        ];
    }
}

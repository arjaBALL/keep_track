<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFundClassificationRequest extends FormRequest
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
            'fund_id' => ['sometimes', 'integer'],
            'account_id' => ['sometimes', 'integer'],
            'property_class_id' => ['sometimes', 'integer'],
            'property_type' => ['sometimes', 'integer'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFundClassificationRequest extends FormRequest
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
            'fund_id' => ['required', 'integer'],
            'account_id' => ['required', 'integer'],
            'property_class_id' => ['required', 'integer'],
            'property_type' => ['required', 'integer'],
        ];
    }
}

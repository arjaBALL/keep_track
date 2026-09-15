<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRegistrationRequest extends FormRequest
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
            'classification_id' => ['sometimes', 'integer'],
            'identification_id' => ['sometimes', 'integer'],
            'description_id' => ['sometimes', 'integer'],
            'valuation_id' => ['sometimes', 'integer'],
            'accountability_id' => ['sometimes', 'integer'],
            'location_id' => ['sometimes', 'integer'],
            'status_id' => ['sometimes', 'integer'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRegistrationRequest extends FormRequest
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
            'classification_id' => ['required', 'integer'],
            'identification_id' => ['required', 'integer'],
            'description_id' => ['required', 'integer'],
            'valuation_id' => ['required', 'integer'],
            'accountability_id' => ['required', 'integer'],
            'location_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
        ];
    }
}

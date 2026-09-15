<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDescriptionAcquisitionRequest extends FormRequest
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
            'acquisition_date' => ['sometimes', 'date'],
            'quantity' => ['sometimes', 'integer'],
            'unit' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
        ];
    }
}

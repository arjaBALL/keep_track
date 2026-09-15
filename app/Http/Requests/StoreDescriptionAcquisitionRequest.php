<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDescriptionAcquisitionRequest extends FormRequest
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
            'acquisition_date' => ['required', 'date'],
            'quantity' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}

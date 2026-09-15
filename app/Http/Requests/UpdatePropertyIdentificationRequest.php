<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyIdentificationRequest extends FormRequest
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
            'ics_par_no' => ['sometimes', 'string'],
            'ics_par_date' => ['sometimes', 'date'],
            'engas_old_property_no' => ['sometimes', 'string'],
            'old_property_no' => ['sometimes', 'string'],
            'new_property_no' => ['sometimes', 'string'],
        ];
    }
}

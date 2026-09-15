<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyIdentificationRequest extends FormRequest
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
            'ics_par_no' => ['required', 'string'],
            'ics_par_date' => ['required', 'date'],
            'engas_old_property_no' => ['required', 'string'],
            'old_property_no' => ['required', 'string'],
            'new_property_no' => ['required', 'string'],
        ];
    }
}

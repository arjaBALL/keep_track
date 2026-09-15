<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationConditionRequest extends FormRequest
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
            'location_id' => ['sometimes', 'integer'],
            'condition_of_ppe' => ['sometimes', 'string'],
            'remarks' => ['sometimes', 'string'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountabilityPhysicalCountRequest extends FormRequest
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
            'balance_per_card' => ['sometimes', 'integer'],
            'on_hand_per_count' => ['sometimes', 'integer'],
            'responsibility_center_id' => ['sometimes', 'integer'],
            'accountable_officer_id' => ['sometimes', 'integer'],
        ];
    }
}

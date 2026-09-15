<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountabilityPhysicalCountRequest extends FormRequest
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
            'balance_per_card' => ['required', 'integer'],
            'on_hand_per_count' => ['required', 'integer'],
            'responsibility_center_id' => ['required', 'integer'],
            'accountable_officer_id' => ['required', 'integer'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'table' => ['sometimes', 'string'],
            'username' => ['sometimes', 'string'],
            'role_id' => ['sometimes', 'integer'],           
        ];
    }
}
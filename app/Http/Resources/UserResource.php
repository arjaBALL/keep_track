<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 */
class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [        
            'id' => $this->id,
            'username' => $this->username,
            'role_id' => $this->role_id,
            'created_at' => $this->created_at,          
        ];
    }
}
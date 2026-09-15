<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\AccountabilityPhysicalCount
 */
class AccountabilityPhysicalCountResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'balance_per_card' => $this->balance_per_card,
            'on_hand_per_count' => $this->on_hand_per_count,
            'responsibility_center_id' => $this->responsibility_center_id,
            'accountable_officer_id' => $this->accountable_officer_id,
        ];
    }
}

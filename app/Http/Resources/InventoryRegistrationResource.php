<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\InventoryRegistration
 */
class InventoryRegistrationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'classification_id' => $this->classification_id,
            'identification_id' => $this->identification_id,
            'description_id' => $this->description_id,
            'valuation_id' => $this->valuation_id,
            'accountability_id' => $this->accountability_id,
            'location_id' => $this->location_id,
            'status_id' => $this->status_id,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\DescriptionAcquisition
 */
class DescriptionAcquisitionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'acquisition_date' => $this->acquisition_date,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'description' => $this->description,
        ];
    }
}

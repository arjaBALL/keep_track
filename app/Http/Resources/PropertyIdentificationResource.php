<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\PropertyIdentification
 */
class PropertyIdentificationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ics_par_no' => $this->ics_par_no,
            'ics_par_date' => $this->ics_par_date,
            'engas_old_property_no' => $this->engas_old_property_no,
            'old_property_no' => $this->old_property_no,
            'new_property_no' => $this->new_property_no,
        ];
    }
}

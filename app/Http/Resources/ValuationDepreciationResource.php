<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\ValuationDepreciation
 */
class ValuationDepreciationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'estimated_life' => $this->estimated_life,
            'unit_value' => $this->unit_value,
            'salvage_value' => $this->salvage_value,
            'monthly_depreciation' => $this->monthly_depreciation,
            'month_id' => $this->month_id,
            'accumulated_depreciation' => $this->accumulated_depreciation,
            'net_book_value' => $this->net_book_value,
        ];
    }
}

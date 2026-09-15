<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ValuationDepreciation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'estimated_life',
        'unit_value',
        'salvage_value',
        'monthly_depreciation',
        'month_id',
        'accumulated_depreciation',
        'net_book_value',
    ];

    protected function casts(): array
    {
        return [
        'unit_value' => 'decimal:2',
        'salvage_value' => 'decimal:2',
        'monthly_depreciation' => 'decimal:2',
        'accumulated_depreciation' => 'decimal:2',
        'net_book_value' => 'decimal:2',
        ];
    }


}

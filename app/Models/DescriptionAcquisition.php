<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class DescriptionAcquisition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'acquisition_date',
        'quantity',
        'unit',
        'description',
    ];

    protected function casts(): array
    {
        return [
        'acquisition_date' => 'datetime',
        ];
    }

    public function inventoryRegisters(): HasMany
        {
            return $this->hasMany(
                InventoryRegistration::class,
                'description_id'
            );
        }
}
<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PropertyIdentification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ics_par_no',
        'ics_par_date',
        'engas_old_property_no',
        'old_property_no',
        'new_property_no',
    ];

    protected function casts(): array
        {
            return [
            'ics_par_date' => 'datetime',
            ];
        }

    public function inventoryRegisters(): HasMany
        {
            return $this->hasMany(
                InventoryRegistration::class,
                'identification_id'
            );
        }
}
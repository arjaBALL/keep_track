<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class LocationCondition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'location_id',
        'condition_of_ppe',
        'remarks',
    ];



    public function inventoryRegisters(): HasMany
        {
            return $this->hasMany(
                InventoryRegistration::class,
                'location_id'
            );
        }

    public function location(): BelongsTo
        {
            return $this->belongsTo(
                Location::class,
                'location_id'
            );
        }
}
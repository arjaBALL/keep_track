<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AccountabilityStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status_id',
        'are_on',
    ];

    protected function casts(): array
    {
        return [
        'are_on' => 'datetime',
        ];
    }

    public function inventoryRegisters(): HasMany
        {
            return $this->hasMany(
                InventoryRegistration::class,
                'status_id'
            );
        }

    public function status(): BelongsTo
        {
            return $this->belongsTo(
                Status::class,
                'status_id'
            );
        }


}
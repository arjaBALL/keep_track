<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountabilityPhysicalCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance_per_card',
        'on_hand_per_count',
        'responsibility_center_id',
        'accountable_officer_id',
    ];

    protected $casts = [
        'balance_per_card' => 'decimal:2',
        'on_hand_per_count' => 'decimal:2',
    ];

    public function accountableOfficer(): BelongsTo
    {
        return $this->belongsTo(
            AccountableOfficer::class,
            'accountable_officer_id'
        );
    }

    public function inventoryRegisters(): HasMany
    {
        return $this->hasMany(
            InventoryRegistration::class,
            'accountability_id'
        );
    }

    public function responsibilityCenter(): BelongsTo
    {
        return $this->belongsTo(
            ResponsibilityCenter::class,
            'responsibility_center_id'
        );
    }
}
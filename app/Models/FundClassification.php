<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FundClassification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fund_id',
        'account_id',
        'property_class_id',
        'property_type',
    ];


    public function account(): BelongsTo
        {
            return $this->belongsTo(
                AccountCode::class,
                'account_id'
            );
        }

    public function fund(): BelongsTo
        {
            return $this->belongsTo(
                Fund::class,
                'fund_id'
            );
        }

    public function inventoryRegisters(): HasMany
        {
            return $this->hasMany(
                InventoryRegistration::class,
                'classification_id'
            );
        }

    public function propertyClass(): BelongsTo
        {
            return $this->belongsTo(
                PropertyClass::class,
                'property_class_id'
            );
        }

    public function propertyType(): BelongsTo
        {
            return $this->belongsTo(
                PropertyType::class,
                'property_type'
            );
        }

}
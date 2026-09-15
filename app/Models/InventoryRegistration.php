<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InventoryRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'classification_id',
        'identification_id',
        'description_id',
        'valuation_id',
        'accountability_id',
        'location_id',
        'status_id',
    ];

    public function accountability(): BelongsTo
        {
            return $this->belongsTo(
                AccountabilityPhysicalCount::class,
                'accountability_id'
            );
        }

    public function classification(): BelongsTo
        {
            return $this->belongsTo(
                FundClassification::class,
                'classification_id'
            );
        }

    public function description(): BelongsTo
        {
            return $this->belongsTo(
                DescriptionAcquisition::class,
                'description_id'
            );
        }

    public function identification(): BelongsTo
        {
            return $this->belongsTo(
                PropertyIdentification::class,
                'identification_id'
            );
        }

    public function location(): BelongsTo
        {
            return $this->belongsTo(
                LocationCondition::class,
                'location_id'
            );
        }

    public function status(): BelongsTo
        {
            return $this->belongsTo(
                AccountabilityStatus::class,
                'status_id'
            );
        }

    public function valuation(): BelongsTo
        {
            return $this->belongsTo(
                ValuationDepreciation::class,
                'valuation_id'
            );
        }


}
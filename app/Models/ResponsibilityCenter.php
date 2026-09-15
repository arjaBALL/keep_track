<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ResponsibilityCenter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'responsibility_center_name',        
    ];


    public function accountabilityPhysicalCounts(): HasMany
        {
            return $this->hasMany(
            AccountabilityPhysicalCount::class,
                'responsibility_center_id'
            );
        }

}
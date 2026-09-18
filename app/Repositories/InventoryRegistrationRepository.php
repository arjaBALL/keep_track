<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\InventoryRegistration;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InventoryRegistrationRepository
{
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = InventoryRegistration::with([
            'classification.fund',
            'classification.account',
            'classification.propertyClass',
            'classification.propertyType',
            'identification',
            'description',
            'valuation',
            'accountability.responsibilityCenter',
            'accountability.accountableOfficer',
            'locationCondition.location',
            'location.location',
        ]);

        $this->applySearch($query, $filters['search'] ?? null);
        
        return $query->paginate($perPage);

    }

    protected function applySearch($query, ?string $search): void
        {
            if (blank($search))
                {
                    return;
                }

        $query->where(function ($q) use ($search) {

                $q->whereHas('identification', fn($sub) =>
                    $sub->where('ics_par_no', 'like', "%{$search}%")
                        ->orWhere('new_property_no', 'like', "%{$search}%")
                        ->orWhere('old_property_no', 'like', "%{$search}%")
                        ->orWhere('engas_old_property_no', 'like', "%{$search}%")
                        ->orWhere('ics_par_date', 'like', "%{$search}%")
                );

                $q->orWhereHas('locationCondition.location', fn($sub) =>
                    $sub->where('location_name', 'like', "%{$search}%")
                );

                $q->orWhereHas('description', fn($sub) =>
                    $sub->where('quantity', 'like', "%{$search}%")
                        ->orWhere('unit', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                );

                $q->orWhereHas('valuation', fn($sub) =>
                    $sub->where('unit_value', 'like', "%{$search}%")
                        ->orWhere('salvage_value', 'like', "%{$search}%")
                        ->orWhere('estimated_life', 'like', "%{$search}%")
                        ->orWhere('monthly_depreciation', 'like', "%{$search}%")
                        ->orWhere('accumulated_depreciation', 'like', "%{$search}%")
                        ->orWhere('net_book_value', 'like', "%{$search}%")
                );

                $q->orWhereHas('accountability.accountableOfficer', fn($sub) =>
                    $sub->where('name', 'like', "%{$search}%")
                );

            });
        }

    public function all(): Collection
    {
        return InventoryRegistration::all();
    }

    public function findOrFail(int|string $id): InventoryRegistration
    {
        return InventoryRegistration::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): InventoryRegistration
    {
        return InventoryRegistration::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(InventoryRegistration $inventoryRegistration, array $data): InventoryRegistration
    {
        $inventoryRegistration->update($data);

        return $inventoryRegistration->refresh();
    }

    public function delete(InventoryRegistration $inventoryRegistration): bool
    {
        return (bool) $inventoryRegistration->delete();
    }
}
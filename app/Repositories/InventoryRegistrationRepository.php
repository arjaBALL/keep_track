<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\InventoryRegistration;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InventoryRegistrationRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return InventoryRegistration::query()->paginate($perPage);
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

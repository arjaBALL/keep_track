<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\InventoryRegistration;
use App\Repositories\InventoryRegistrationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InventoryRegistrationService
{
    public function __construct(
        private readonly InventoryRegistrationRepository $repository,
    ) {}

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
        {
            return $this->repository->paginate($perPage, $filters);
        }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): InventoryRegistration
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): InventoryRegistration
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(InventoryRegistration $inventoryRegistration, array $data): InventoryRegistration
    {
        return $this->repository->update($inventoryRegistration, $data);
    }

    public function delete(InventoryRegistration $inventoryRegistration): bool
    {
        return $this->repository->delete($inventoryRegistration);
    }
}
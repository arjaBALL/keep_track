<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PropertyType;
use App\Repositories\PropertyTypeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyTypeService
{
    public function __construct(
        private readonly PropertyTypeRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): PropertyType
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyType
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyType $propertyType, array $data): PropertyType
    {
        return $this->repository->update($propertyType, $data);
    }

    public function delete(PropertyType $propertyType): bool
    {
        return $this->repository->delete($propertyType);
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PropertyClass;
use App\Repositories\PropertyClassRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyClassService
{
    public function __construct(
        private readonly PropertyClassRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): PropertyClass
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyClass
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyClass $propertyClass, array $data): PropertyClass
    {
        return $this->repository->update($propertyClass, $data);
    }

    public function delete(PropertyClass $propertyClass): bool
    {
        return $this->repository->delete($propertyClass);
    }
}

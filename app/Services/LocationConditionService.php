<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\LocationCondition;
use App\Repositories\LocationConditionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LocationConditionService
{
    public function __construct(
        private readonly LocationConditionRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): LocationCondition
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): LocationCondition
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(LocationCondition $locationCondition, array $data): LocationCondition
    {
        return $this->repository->update($locationCondition, $data);
    }

    public function delete(LocationCondition $locationCondition): bool
    {
        return $this->repository->delete($locationCondition);
    }
}

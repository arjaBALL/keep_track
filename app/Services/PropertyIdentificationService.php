<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PropertyIdentification;
use App\Repositories\PropertyIdentificationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyIdentificationService
{
    public function __construct(
        private readonly PropertyIdentificationRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): PropertyIdentification
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyIdentification
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyIdentification $propertyIdentification, array $data): PropertyIdentification
    {
        return $this->repository->update($propertyIdentification, $data);
    }

    public function delete(PropertyIdentification $propertyIdentification): bool
    {
        return $this->repository->delete($propertyIdentification);
    }
}

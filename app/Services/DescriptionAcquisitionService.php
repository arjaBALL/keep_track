<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DescriptionAcquisition;
use App\Repositories\DescriptionAcquisitionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DescriptionAcquisitionService
{
    public function __construct(
        private readonly DescriptionAcquisitionRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): DescriptionAcquisition
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): DescriptionAcquisition
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(DescriptionAcquisition $descriptionAcquisition, array $data): DescriptionAcquisition
    {
        return $this->repository->update($descriptionAcquisition, $data);
    }

    public function delete(DescriptionAcquisition $descriptionAcquisition): bool
    {
        return $this->repository->delete($descriptionAcquisition);
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FundClassification;
use App\Repositories\FundClassificationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FundClassificationService
{
    public function __construct(
        private readonly FundClassificationRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): FundClassification
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): FundClassification
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(FundClassification $fundClassification, array $data): FundClassification
    {
        return $this->repository->update($fundClassification, $data);
    }

    public function delete(FundClassification $fundClassification): bool
    {
        return $this->repository->delete($fundClassification);
    }
}

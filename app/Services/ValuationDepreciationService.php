<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ValuationDepreciation;
use App\Repositories\ValuationDepreciationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ValuationDepreciationService
{
    public function __construct(
        private readonly ValuationDepreciationRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): ValuationDepreciation
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): ValuationDepreciation
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(ValuationDepreciation $valuationDepreciation, array $data): ValuationDepreciation
    {
        return $this->repository->update($valuationDepreciation, $data);
    }

    public function delete(ValuationDepreciation $valuationDepreciation): bool
    {
        return $this->repository->delete($valuationDepreciation);
    }
}

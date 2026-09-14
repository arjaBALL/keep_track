<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Fund;
use App\Repositories\FundRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FundService
{
    public function __construct(
        private readonly FundRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): Fund
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Fund
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Fund $fund, array $data): Fund
    {
        return $this->repository->update($fund, $data);
    }

    public function delete(Fund $fund): bool
    {
        return $this->repository->delete($fund);
    }
}

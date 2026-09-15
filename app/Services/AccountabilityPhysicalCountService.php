<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AccountabilityPhysicalCount;
use App\Repositories\AccountabilityPhysicalCountRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountabilityPhysicalCountService
{
    public function __construct(
        private readonly AccountabilityPhysicalCountRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): AccountabilityPhysicalCount
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountabilityPhysicalCount
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountabilityPhysicalCount $accountabilityPhysicalCount, array $data): AccountabilityPhysicalCount
    {
        return $this->repository->update($accountabilityPhysicalCount, $data);
    }

    public function delete(AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return $this->repository->delete($accountabilityPhysicalCount);
    }
}

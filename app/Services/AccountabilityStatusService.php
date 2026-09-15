<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AccountabilityStatus;
use App\Repositories\AccountabilityStatusRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountabilityStatusService
{
    public function __construct(
        private readonly AccountabilityStatusRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): AccountabilityStatus
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountabilityStatus
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountabilityStatus $accountabilityStatus, array $data): AccountabilityStatus
    {
        return $this->repository->update($accountabilityStatus, $data);
    }

    public function delete(AccountabilityStatus $accountabilityStatus): bool
    {
        return $this->repository->delete($accountabilityStatus);
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AccountableOfficer;
use App\Repositories\AccountableOfficerRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountableOfficerService
{
    public function __construct(
        private readonly AccountableOfficerRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): AccountableOfficer
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountableOfficer
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountableOfficer $accountableOfficer, array $data): AccountableOfficer
    {
        return $this->repository->update($accountableOfficer, $data);
    }

    public function delete(AccountableOfficer $accountableOfficer): bool
    {
        return $this->repository->delete($accountableOfficer);
    }
}

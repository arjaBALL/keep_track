<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AccountCode;
use App\Repositories\AccountCodeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountCodeService
{
    public function __construct(
        private readonly AccountCodeRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): AccountCode
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountCode
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountCode $accountCode, array $data): AccountCode
    {
        return $this->repository->update($accountCode, $data);
    }

    public function delete(AccountCode $accountCode): bool
    {
        return $this->repository->delete($accountCode);
    }
}

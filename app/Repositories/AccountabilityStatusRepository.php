<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AccountabilityStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountabilityStatusRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return AccountabilityStatus::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return AccountabilityStatus::all();
    }

    public function findOrFail(int|string $id): AccountabilityStatus
    {
        return AccountabilityStatus::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountabilityStatus
    {
        return AccountabilityStatus::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountabilityStatus $accountabilityStatus, array $data): AccountabilityStatus
    {
        $accountabilityStatus->update($data);

        return $accountabilityStatus->refresh();
    }

    public function delete(AccountabilityStatus $accountabilityStatus): bool
    {
        return (bool) $accountabilityStatus->delete();
    }
}

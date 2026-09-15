<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AccountabilityPhysicalCount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountabilityPhysicalCountRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return AccountabilityPhysicalCount::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return AccountabilityPhysicalCount::all();
    }

    public function findOrFail(int|string $id): AccountabilityPhysicalCount
    {
        return AccountabilityPhysicalCount::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountabilityPhysicalCount
    {
        return AccountabilityPhysicalCount::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountabilityPhysicalCount $accountabilityPhysicalCount, array $data): AccountabilityPhysicalCount
    {
        $accountabilityPhysicalCount->update($data);

        return $accountabilityPhysicalCount->refresh();
    }

    public function delete(AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return (bool) $accountabilityPhysicalCount->delete();
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AccountableOfficer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountableOfficerRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return AccountableOfficer::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return AccountableOfficer::all();
    }

    public function findOrFail(int|string $id): AccountableOfficer
    {
        return AccountableOfficer::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountableOfficer
    {
        return AccountableOfficer::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountableOfficer $accountableOfficer, array $data): AccountableOfficer
    {
        $accountableOfficer->update($data);

        return $accountableOfficer->refresh();
    }

    public function delete(AccountableOfficer $accountableOfficer): bool
    {
        return (bool) $accountableOfficer->delete();
    }
}

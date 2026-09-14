<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AccountCode;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccountCodeRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return AccountCode::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return AccountCode::all();
    }

    public function findOrFail(int|string $id): AccountCode
    {
        return AccountCode::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): AccountCode
    {
        return AccountCode::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(AccountCode $accountCode, array $data): AccountCode
    {
        $accountCode->update($data);

        return $accountCode->refresh();
    }

    public function delete(AccountCode $accountCode): bool
    {
        return (bool) $accountCode->delete();
    }
}

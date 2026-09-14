<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Fund;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FundRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Fund::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return Fund::all();
    }

    public function findOrFail(int|string $id): Fund
    {
        return Fund::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Fund
    {
        return Fund::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Fund $fund, array $data): Fund
    {
        $fund->update($data);

        return $fund->refresh();
    }

    public function delete(Fund $fund): bool
    {
        return (bool) $fund->delete();
    }
}

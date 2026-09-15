<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StatusRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Status::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return Status::all();
    }

    public function findOrFail(int|string $id): Status
    {
        return Status::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Status
    {
        return Status::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Status $status, array $data): Status
    {
        $status->update($data);

        return $status->refresh();
    }

    public function delete(Status $status): bool
    {
        return (bool) $status->delete();
    }
}

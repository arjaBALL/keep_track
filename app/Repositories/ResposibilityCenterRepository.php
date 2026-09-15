<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ResposibilityCenter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ResposibilityCenterRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ResposibilityCenter::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return ResposibilityCenter::all();
    }

    public function findOrFail(int|string $id): ResposibilityCenter
    {
        return ResposibilityCenter::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): ResposibilityCenter
    {
        return ResposibilityCenter::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(ResposibilityCenter $resposibilityCenter, array $data): ResposibilityCenter
    {
        $resposibilityCenter->update($data);

        return $resposibilityCenter->refresh();
    }

    public function delete(ResposibilityCenter $resposibilityCenter): bool
    {
        return (bool) $resposibilityCenter->delete();
    }
}

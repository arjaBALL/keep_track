<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\LocationCondition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LocationConditionRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return LocationCondition::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return LocationCondition::all();
    }

    public function findOrFail(int|string $id): LocationCondition
    {
        return LocationCondition::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): LocationCondition
    {
        return LocationCondition::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(LocationCondition $locationCondition, array $data): LocationCondition
    {
        $locationCondition->update($data);

        return $locationCondition->refresh();
    }

    public function delete(LocationCondition $locationCondition): bool
    {
        return (bool) $locationCondition->delete();
    }
}

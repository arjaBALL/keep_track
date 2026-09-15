<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Location;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Location::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return Location::all();
    }

    public function findOrFail(int|string $id): Location
    {
        return Location::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Location
    {
        return Location::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Location $location, array $data): Location
    {
        $location->update($data);

        return $location->refresh();
    }

    public function delete(Location $location): bool
    {
        return (bool) $location->delete();
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PropertyClass;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyClassRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return PropertyClass::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return PropertyClass::all();
    }

    public function findOrFail(int|string $id): PropertyClass
    {
        return PropertyClass::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyClass
    {
        return PropertyClass::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyClass $propertyClass, array $data): PropertyClass
    {
        $propertyClass->update($data);

        return $propertyClass->refresh();
    }

    public function delete(PropertyClass $propertyClass): bool
    {
        return (bool) $propertyClass->delete();
    }
}

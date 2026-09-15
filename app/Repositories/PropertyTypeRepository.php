<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PropertyType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyTypeRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return PropertyType::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return PropertyType::all();
    }

    public function findOrFail(int|string $id): PropertyType
    {
        return PropertyType::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyType
    {
        return PropertyType::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyType $propertyType, array $data): PropertyType
    {
        $propertyType->update($data);

        return $propertyType->refresh();
    }

    public function delete(PropertyType $propertyType): bool
    {
        return (bool) $propertyType->delete();
    }
}

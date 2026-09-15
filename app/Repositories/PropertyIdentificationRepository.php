<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PropertyIdentification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PropertyIdentificationRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return PropertyIdentification::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return PropertyIdentification::all();
    }

    public function findOrFail(int|string $id): PropertyIdentification
    {
        return PropertyIdentification::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): PropertyIdentification
    {
        return PropertyIdentification::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(PropertyIdentification $propertyIdentification, array $data): PropertyIdentification
    {
        $propertyIdentification->update($data);

        return $propertyIdentification->refresh();
    }

    public function delete(PropertyIdentification $propertyIdentification): bool
    {
        return (bool) $propertyIdentification->delete();
    }
}

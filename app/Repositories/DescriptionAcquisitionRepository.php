<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\DescriptionAcquisition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DescriptionAcquisitionRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return DescriptionAcquisition::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return DescriptionAcquisition::all();
    }

    public function findOrFail(int|string $id): DescriptionAcquisition
    {
        return DescriptionAcquisition::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): DescriptionAcquisition
    {
        return DescriptionAcquisition::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(DescriptionAcquisition $descriptionAcquisition, array $data): DescriptionAcquisition
    {
        $descriptionAcquisition->update($data);

        return $descriptionAcquisition->refresh();
    }

    public function delete(DescriptionAcquisition $descriptionAcquisition): bool
    {
        return (bool) $descriptionAcquisition->delete();
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\FundClassification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FundClassificationRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return FundClassification::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return FundClassification::all();
    }

    public function findOrFail(int|string $id): FundClassification
    {
        return FundClassification::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): FundClassification
    {
        return FundClassification::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(FundClassification $fundClassification, array $data): FundClassification
    {
        $fundClassification->update($data);

        return $fundClassification->refresh();
    }

    public function delete(FundClassification $fundClassification): bool
    {
        return (bool) $fundClassification->delete();
    }
}

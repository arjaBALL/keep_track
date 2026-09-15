<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ValuationDepreciation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ValuationDepreciationRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return ValuationDepreciation::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return ValuationDepreciation::all();
    }

    public function findOrFail(int|string $id): ValuationDepreciation
    {
        return ValuationDepreciation::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): ValuationDepreciation
    {
        return ValuationDepreciation::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(ValuationDepreciation $valuationDepreciation, array $data): ValuationDepreciation
    {
        $valuationDepreciation->update($data);

        return $valuationDepreciation->refresh();
    }

    public function delete(ValuationDepreciation $valuationDepreciation): bool
    {
        return (bool) $valuationDepreciation->delete();
    }
}

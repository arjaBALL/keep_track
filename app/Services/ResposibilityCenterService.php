<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ResposibilityCenter;
use App\Repositories\ResposibilityCenterRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ResposibilityCenterService
{
    public function __construct(
        private readonly ResposibilityCenterRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): ResposibilityCenter
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): ResposibilityCenter
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(ResposibilityCenter $resposibilityCenter, array $data): ResposibilityCenter
    {
        return $this->repository->update($resposibilityCenter, $data);
    }

    public function delete(ResposibilityCenter $resposibilityCenter): bool
    {
        return $this->repository->delete($resposibilityCenter);
    }
}

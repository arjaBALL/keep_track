<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Status;
use App\Repositories\StatusRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class StatusService
{
    public function __construct(
        private readonly StatusRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): Status
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Status
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Status $status, array $data): Status
    {
        return $this->repository->update($status, $data);
    }

    public function delete(Status $status): bool
    {
        return $this->repository->delete($status);
    }
}

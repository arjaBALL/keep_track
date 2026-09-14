<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(
        private readonly RoleRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): Role
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Role
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Role $role, array $data): Role
    {
        return $this->repository->update($role, $data);
    }

    public function delete(Role $role): bool
    {
        return $this->repository->delete($role);
    }
}

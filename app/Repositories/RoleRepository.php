<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Role::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return Role::all();
    }

    public function findOrFail(int|string $id): Role
    {
        return Role::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Role
    {
        return Role::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(Role $role, array $data): Role
    {
        $role->update($data);

        return $role->refresh();
    }

    public function delete(Role $role): bool
    {
        return (bool) $role->delete();
    }
}

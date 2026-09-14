<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return User::query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return User::all();
    }

    public function findOrFail(int|string $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->refresh();
    }

    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}

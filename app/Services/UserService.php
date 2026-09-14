<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int|string $id): User
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): User
    {
        return $this->repository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(User $user, array $data): User
    {
        return $this->repository->update($user, $data);
    }

    public function delete(User $user): bool
    {
        return $this->repository->delete($user);
    }
}

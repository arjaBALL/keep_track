<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, User $user): bool
    {
        return true;
    }

    public function delete(User $user, User $user): bool
    {
        return true;
    }

    public function restore(User $user, User $user): bool
    {
        return true;
    }

    public function forceDelete(User $user, User $user): bool
    {
        return true;
    }
}

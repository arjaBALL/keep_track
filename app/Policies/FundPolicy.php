<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Fund;
use App\Models\User;

class FundPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Fund $fund): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Fund $fund): bool
    {
        return true;
    }

    public function delete(User $user, Fund $fund): bool
    {
        return true;
    }

    public function restore(User $user, Fund $fund): bool
    {
        return true;
    }

    public function forceDelete(User $user, Fund $fund): bool
    {
        return true;
    }
}

<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AccountCode;
use App\Models\User;

class AccountCodePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AccountCode $accountCode): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AccountCode $accountCode): bool
    {
        return true;
    }

    public function delete(User $user, AccountCode $accountCode): bool
    {
        return true;
    }

    public function restore(User $user, AccountCode $accountCode): bool
    {
        return true;
    }

    public function forceDelete(User $user, AccountCode $accountCode): bool
    {
        return true;
    }
}

<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AccountableOfficer;
use App\Models\User;

class AccountableOfficerPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AccountableOfficer $accountableOfficer): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AccountableOfficer $accountableOfficer): bool
    {
        return true;
    }

    public function delete(User $user, AccountableOfficer $accountableOfficer): bool
    {
        return true;
    }

    public function restore(User $user, AccountableOfficer $accountableOfficer): bool
    {
        return true;
    }

    public function forceDelete(User $user, AccountableOfficer $accountableOfficer): bool
    {
        return true;
    }
}

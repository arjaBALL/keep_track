<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\AccountabilityPhysicalCount;
use App\Models\User;

class AccountabilityPhysicalCountPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return true;
    }

    public function delete(User $user, AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return true;
    }

    public function restore(User $user, AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return true;
    }

    public function forceDelete(User $user, AccountabilityPhysicalCount $accountabilityPhysicalCount): bool
    {
        return true;
    }
}

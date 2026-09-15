<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\LocationCondition;
use App\Models\User;

class LocationConditionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, LocationCondition $locationCondition): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, LocationCondition $locationCondition): bool
    {
        return true;
    }

    public function delete(User $user, LocationCondition $locationCondition): bool
    {
        return true;
    }

    public function restore(User $user, LocationCondition $locationCondition): bool
    {
        return true;
    }

    public function forceDelete(User $user, LocationCondition $locationCondition): bool
    {
        return true;
    }
}

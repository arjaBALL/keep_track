<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ResposibilityCenter;
use App\Models\User;

class ResposibilityCenterPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ResposibilityCenter $resposibilityCenter): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ResposibilityCenter $resposibilityCenter): bool
    {
        return true;
    }

    public function delete(User $user, ResposibilityCenter $resposibilityCenter): bool
    {
        return true;
    }

    public function restore(User $user, ResposibilityCenter $resposibilityCenter): bool
    {
        return true;
    }

    public function forceDelete(User $user, ResposibilityCenter $resposibilityCenter): bool
    {
        return true;
    }
}

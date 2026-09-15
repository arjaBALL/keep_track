<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PropertyClass;
use App\Models\User;

class PropertyClassPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PropertyClass $propertyClass): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PropertyClass $propertyClass): bool
    {
        return true;
    }

    public function delete(User $user, PropertyClass $propertyClass): bool
    {
        return true;
    }

    public function restore(User $user, PropertyClass $propertyClass): bool
    {
        return true;
    }

    public function forceDelete(User $user, PropertyClass $propertyClass): bool
    {
        return true;
    }
}

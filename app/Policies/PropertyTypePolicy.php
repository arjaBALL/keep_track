<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PropertyType;
use App\Models\User;

class PropertyTypePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PropertyType $propertyType): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PropertyType $propertyType): bool
    {
        return true;
    }

    public function delete(User $user, PropertyType $propertyType): bool
    {
        return true;
    }

    public function restore(User $user, PropertyType $propertyType): bool
    {
        return true;
    }

    public function forceDelete(User $user, PropertyType $propertyType): bool
    {
        return true;
    }
}

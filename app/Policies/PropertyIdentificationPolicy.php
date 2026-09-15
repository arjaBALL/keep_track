<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PropertyIdentification;
use App\Models\User;

class PropertyIdentificationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PropertyIdentification $propertyIdentification): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PropertyIdentification $propertyIdentification): bool
    {
        return true;
    }

    public function delete(User $user, PropertyIdentification $propertyIdentification): bool
    {
        return true;
    }

    public function restore(User $user, PropertyIdentification $propertyIdentification): bool
    {
        return true;
    }

    public function forceDelete(User $user, PropertyIdentification $propertyIdentification): bool
    {
        return true;
    }
}

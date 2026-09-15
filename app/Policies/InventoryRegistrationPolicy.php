<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\InventoryRegistration;
use App\Models\User;

class InventoryRegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, InventoryRegistration $inventoryRegistration): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, InventoryRegistration $inventoryRegistration): bool
    {
        return true;
    }

    public function delete(User $user, InventoryRegistration $inventoryRegistration): bool
    {
        return true;
    }

    public function restore(User $user, InventoryRegistration $inventoryRegistration): bool
    {
        return true;
    }

    public function forceDelete(User $user, InventoryRegistration $inventoryRegistration): bool
    {
        return true;
    }
}

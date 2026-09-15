<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\DescriptionAcquisition;
use App\Models\User;

class DescriptionAcquisitionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DescriptionAcquisition $descriptionAcquisition): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DescriptionAcquisition $descriptionAcquisition): bool
    {
        return true;
    }

    public function delete(User $user, DescriptionAcquisition $descriptionAcquisition): bool
    {
        return true;
    }

    public function restore(User $user, DescriptionAcquisition $descriptionAcquisition): bool
    {
        return true;
    }

    public function forceDelete(User $user, DescriptionAcquisition $descriptionAcquisition): bool
    {
        return true;
    }
}

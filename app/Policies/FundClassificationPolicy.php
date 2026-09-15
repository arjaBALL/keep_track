<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\FundClassification;
use App\Models\User;

class FundClassificationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, FundClassification $fundClassification): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, FundClassification $fundClassification): bool
    {
        return true;
    }

    public function delete(User $user, FundClassification $fundClassification): bool
    {
        return true;
    }

    public function restore(User $user, FundClassification $fundClassification): bool
    {
        return true;
    }

    public function forceDelete(User $user, FundClassification $fundClassification): bool
    {
        return true;
    }
}

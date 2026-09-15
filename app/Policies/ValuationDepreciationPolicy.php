<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ValuationDepreciation;
use App\Models\User;

class ValuationDepreciationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ValuationDepreciation $valuationDepreciation): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ValuationDepreciation $valuationDepreciation): bool
    {
        return true;
    }

    public function delete(User $user, ValuationDepreciation $valuationDepreciation): bool
    {
        return true;
    }

    public function restore(User $user, ValuationDepreciation $valuationDepreciation): bool
    {
        return true;
    }

    public function forceDelete(User $user, ValuationDepreciation $valuationDepreciation): bool
    {
        return true;
    }
}

<?php

namespace App\Domains\Auth\Models\Traits\Method;

use Illuminate\Support\Collection;

/**
 * Trait RoleMethod.
 */
trait PermissionMethod
{
    /**
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->name === config('boilerplate.access.role.admin');
    }

    /**
     * @return Collection
     */
    public function getParentName(): Collection
    {
        return $this->parent()->pluck('name');
    }
}

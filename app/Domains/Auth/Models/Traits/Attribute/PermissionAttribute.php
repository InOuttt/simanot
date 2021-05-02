<?php

namespace App\Domains\Auth\Models\Traits\Attribute;

/**
 * Trait RoleAttribute.
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getParentLabelAttribute(): string
    {
        return collect($this->getParentName())
            ->implode('<br/>');
    }
}

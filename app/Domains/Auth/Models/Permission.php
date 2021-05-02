<?php

namespace App\Domains\Auth\Models;

use App\Domains\Auth\Models\Traits\Relationship\PermissionRelationship;
use App\Domains\Auth\Models\Traits\Scope\PermissionScope;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Domains\Auth\Models\Traits\Attribute\PermissionAttribute;
use App\Domains\Auth\Models\Traits\Method\PermissionMethod;

/**
 * Class Permission.
 */
class Permission extends SpatiePermission
{
    use PermissionRelationship,
        PermissionMethod,
        PermissionAttribute,
        PermissionScope;
}

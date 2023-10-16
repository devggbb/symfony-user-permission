<?php

namespace Ggbb\SymfonyUserPermission\Permission;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionGroupInterface;

abstract class AbstractPermission implements PermissionGroupInterface
{
    public function getPermissions(): array
    {
        return [];
    }
}
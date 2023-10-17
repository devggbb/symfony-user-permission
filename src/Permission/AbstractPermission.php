<?php

namespace Ggbb\SymfonyUserPermission\Permission;

use Ggbb\SymfonyUserPermission\Exception\PermissionNotFoundException;
use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionGroupInterface;
use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

abstract class AbstractPermission implements PermissionGroupInterface
{
    public function getPermission(string $permissionConst): ?PermissionInterface
    {
        $permissions = $this->getPermissions();
        if (!$permissions || empty($permissions[$permissionConst])) {
            throw new PermissionNotFoundException($permissionConst);
        }

        return new Permission(...$this->getPermissions()[$permissionConst]);
    }
}
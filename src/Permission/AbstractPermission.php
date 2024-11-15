<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Permission;

use Ggbb\SymfonyUserPermissionBundle\Exception\PermissionNotFoundException;
use Ggbb\SymfonyUserPermissionBundle\Permission\Interface\PermissionGroupInterface;
use Ggbb\SymfonyUserPermissionBundle\Permission\Interface\PermissionInterface;

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
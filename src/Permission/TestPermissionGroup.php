<?php

namespace Ggbb\SymfonyUserPermission\Permission;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionGroupInterface;
use Ggbb\SymfonyUserPermission\Permission\Permission\TestPermission;

class TestPermissionGroup implements PermissionGroupInterface
{
    public function getName(): string
    {
        return 'TestGroupName';
    }

    public function getPermissions(): array
    {
        return [
            TestPermission::class
        ];
    }
}
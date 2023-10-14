<?php

namespace Ggbb\SymfonyUserPermission\Permission\Permission;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

class TestPermission implements PermissionInterface
{
    static public function getTitle(): string
    {
        return 'Test permission';
    }
}
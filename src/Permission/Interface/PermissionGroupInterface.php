<?php

namespace Ggbb\SymfonyUserPermission\Permission\Interface;

interface PermissionGroupInterface
{
    public function getName(): string;

    /**
     * @return array|PermissionInterface[]
     */
    public function getPermissions(): array;
    /**
     * @return PermissionInterface
     */
    public function getPermission(string $permissionConst): ?PermissionInterface;
}
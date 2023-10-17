<?php

namespace Ggbb\SymfonyUserPermission\Permission;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

class Permission implements PermissionInterface
{
    public function __construct(
        private readonly string $title,
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
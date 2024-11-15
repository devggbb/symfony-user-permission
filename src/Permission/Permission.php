<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Permission;

use Ggbb\SymfonyUserPermissionBundle\Permission\Interface\PermissionInterface;

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
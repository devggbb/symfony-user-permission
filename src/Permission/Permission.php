<?php

namespace Ggbb\SymfonyUserPermission\Permission;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

class Permission implements PermissionInterface
{
    public function __construct(
        private readonly string $title,
        private readonly ?string $userField = null,
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserField(): ?string
    {
        return $this->userField;
    }
}
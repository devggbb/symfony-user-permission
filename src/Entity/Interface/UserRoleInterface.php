<?php

namespace Ggbb\SymfonyUserPermission\Entity\Interface;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

interface UserRoleInterface
{
    public function getPermissions(): ?array;

    public function setPermissions(array $permissions): static;

    public function getRole(): string;

    public function setRole(string $role): static;
}
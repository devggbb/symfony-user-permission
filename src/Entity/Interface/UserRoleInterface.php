<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Entity\Interface;

use Ggbb\SymfonyUserPermissionBundle\Permission\Interface\PermissionInterface;

interface UserRoleInterface
{
    public function getPermissions(): ?array;

    public function setPermissions(array $permissions): static;

    public function getRole(): string;

    public function setRole(string $role): static;
}
<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Entity\Interface;

interface UserRoleFieldInterface
{
    public function getUserRole(): ?UserRoleInterface;
    public function setUserRole(?UserRoleInterface $userRole): static;
    public function getRoles(): array;
}
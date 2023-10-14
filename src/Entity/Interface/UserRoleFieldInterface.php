<?php

namespace Ggbb\SymfonyUserPermission\Entity\Interface;

interface UserRoleFieldInterface
{
    public function getUserRole(): ?UserRoleInterface;
    public function setUserRole(?UserRoleInterface $userRole): static;
}
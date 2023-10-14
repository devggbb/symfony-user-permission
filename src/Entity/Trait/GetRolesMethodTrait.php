<?php

namespace Ggbb\SymfonyUserPermission\Entity\Trait;

trait GetRolesMethodTrait
{
    public function getRoles(): array
    {
        if (!$this->userRole || !$this->userRole->getRole()) {
            return ['ROLE_USER'];
        }

        return [$this->userRole->getRole()];
    }
}
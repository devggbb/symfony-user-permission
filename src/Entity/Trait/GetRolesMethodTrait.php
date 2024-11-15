<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Entity\Trait;

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
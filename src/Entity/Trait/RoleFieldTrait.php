<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait RoleFieldTrait
{
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
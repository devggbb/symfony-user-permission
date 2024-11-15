<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait RolePermissionFieldTrait
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $permissions = null;

    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): static
    {
        $this->permissions = $permissions;

        return $this;
    }
}
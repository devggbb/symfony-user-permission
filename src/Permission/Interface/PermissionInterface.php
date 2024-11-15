<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Permission\Interface;

interface PermissionInterface
{
    public function getTitle(): string;
}
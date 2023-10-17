<?php

namespace Ggbb\SymfonyUserPermission\Permission\Interface;

interface PermissionInterface
{
    public function getTitle(): string;
    public function getUserField(): ?string;
}
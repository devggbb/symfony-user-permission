<?php

namespace Ggbb\SymfonyUserPermission\Service;

use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionGroupInterface;
use Ggbb\SymfonyUserPermission\Permission\Interface\PermissionInterface;

class PermissionService
{
    public function __construct(
        private readonly array $permissionMapping,
    )
    {
    }

    public function hisPermission(string $attribute): bool
    {
        if (!$attribute || !$this->getExplodeNamePermission($attribute)) {
            return false;
        }

        return true;
    }

    public function isPermission(string $attribute, mixed $subject = null): bool
    {
        if (!$this->hisPermission($attribute)) {
            return false;
        }

        if (!$this->getPermission($attribute, $subject)) {
            return false;
        }

        return true;
    }

    private function getExplodeNamePermission(string $attribute): ?array
    {
        $attributeParts = explode("::", $attribute);
        if (count($attributeParts) !== 2) {
            return null;
        }

        return $attributeParts;
    }

    public function getPermission(string $attribute, mixed $subject = null): ?PermissionInterface
    {
        $attributeParts = $this->getExplodeNamePermission($attribute);
        if (!$attributeParts) {
            return null;
        }

        if (!isset($this->permissionMapping[$attributeParts[0]])) {
            return null;
        }

        $permissionGroupClassName = $this->permissionMapping[$attributeParts[0]];
        /** @var PermissionGroupInterface $permissionGroup */
        $permissionGroup = new $permissionGroupClassName();
        $permission = $permissionGroup->getPermission($attribute);

        if ($permission->getUserField()) {
            // TODO: Доделать
            dd('Доделать');
        }

        return $permission;
    }
}
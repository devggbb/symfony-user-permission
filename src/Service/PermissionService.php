<?php

namespace Ggbb\SymfonyUserPermission\Service;


class PermissionService
{
    public function __construct(
        private readonly array $permissionMapping,
    )
    {
    }

    public function hisPermission(string $attribute): bool
    {
        if (!$attribute || count($this->getExplodeNamePermission($attribute)) === 0) {
            return false;
        }

        return true;
    }

    public function isPermission(string $attribute): bool
    {
        if (!$this->hisPermission($attribute)) {
            return false;
        }

        $namePermission = $this->getExplodeNamePermission($attribute);
        if (!isset($this->permissionMapping[$namePermission[0]])) {
            return false;
        }

        return true;
    }

    private function getExplodeNamePermission($attribute): array
    {
        $attributeParts = explode("::", $attribute);
        if (count($attributeParts) !== 2) {
            return [];
        }

        return $attributeParts;
    }
}
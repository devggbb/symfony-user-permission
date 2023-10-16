<?php

namespace Ggbb\SymfonyUserPermission\Service;

class PermissionService
{
    public function isPermission(string $attribute): bool {
        if (!$attribute) {
            return false;
        }

        $attributeParts = explode("::", $attribute);
        if (count($attributeParts) !== 2) {
            return false;
        }



        return true;
    }
}
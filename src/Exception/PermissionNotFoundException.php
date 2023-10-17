<?php

namespace Ggbb\SymfonyUserPermission\Exception;

class PermissionNotFoundException extends \Exception
{
    public function __construct(string $attribute, int $code = 0, ?\Throwable $previous = null)
    {
        $message = "Permission {$attribute} not found";
        parent::__construct($message, $code, $previous);
    }
}
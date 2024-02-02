<?php

namespace Ggbb\SymfonyUserPermission\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationUserNotFoundException extends AuthenticationException
{
    public function getMessageKey(): string
    {
        return 'User not found';
    }
}

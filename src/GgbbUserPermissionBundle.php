<?php

namespace Ggbb\SymfonyUserPermission;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class GgbbUserPermissionBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
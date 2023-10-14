<?php

namespace Ggbb\SymfonyUserPermission\Repository\Trait;

use Symfony\Component\Security\Core\User\UserInterface;

trait UserRoleUserLoaderTrait
{
    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u, ur')
            ->leftJoin('u.userRole', 'ur')
            ->where('u.phone = :phone')
            ->setParameter('phone', $identifier)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
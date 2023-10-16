<?php

namespace Ggbb\SymfonyUserPermission\Security\Voter;

use Ggbb\SymfonyUserPermission\Service\PermissionService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class PermissionVoter extends Voter
{
    public function __construct(
    )
    {
    }
    protected function supports($attribute, $subject): bool
    {


        dump('1 Test - '. $attribute);
        return false;

        dump('1');
            return  true;
        dump('Start');


        //$res = $this->permissionService->isPermission($attribute);

        dump($res);









        dd('End');

        //    $pieces = explode("::", $attribute);


    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        return false;
    }
}
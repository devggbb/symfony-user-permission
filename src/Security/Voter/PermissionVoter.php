<?php

namespace Ggbb\SymfonyUserPermission\Security\Voter;

use Ggbb\SymfonyUserPermission\Entity\Interface\UserRoleFieldInterface;
use Ggbb\SymfonyUserPermission\Service\PermissionService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PermissionVoter extends Voter
{
    public function __construct(
        private readonly PermissionService $permissionService,
        private readonly Security $security,
    )
    {
    }
    protected function supports($attribute, $subject): bool
    {
        if (!$this->permissionService->hisPermission($attribute) || !$this->security->getUser()) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        if (!$this->permissionService->isPermission($attribute)) {
            return false;
        }

        /** @var UserRoleFieldInterface $user */
        $user = $this->security->getUser();
        $userRole = $user->getUserRole();

        if ($subject && $subject !== $user) {
            return false;
        }

        if (!in_array($attribute, $userRole->getPermissions())) {
            return false;
        }

        return true;
    }
}
<?php

namespace Ggbb\SymfonyUserPermission\Security;

use Doctrine\ORM\EntityManagerInterface;
use Ggbb\SymfonyUserPermission\GgbbUserPermissionBundle;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ContainerBagInterface  $container,
    )
    {
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $userName = $this->container->get(GgbbUserPermissionBundle::CONFIG_USER);
        /** @var UserLoaderInterface $userRepository */
        $userRepository = $this->entityManager->getRepository($userName);

        return $userRepository->loadUserByIdentifier($identifier);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        throw new \Exception('TODO: fill in refreshUser() inside ' . __FILE__);
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }
}
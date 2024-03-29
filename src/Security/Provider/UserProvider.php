<?php

namespace Ggbb\SymfonyUserPermission\Security\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Ggbb\SymfonyUserPermission\Exception\AuthenticationUserNotFoundException;
use Ggbb\SymfonyUserPermission\GgbbUserPermissionBundle;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ContainerBagInterface  $container,
    )
    {
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $userName = $this->container->get(GgbbUserPermissionBundle::CONFIG_USER);
        /** @var UserLoaderInterface $userRepository */
        $userRepository = $this->entityManager->getRepository($userName);

        $user = $userRepository->loadUserByIdentifier($identifier);
        if (!$user) {
            throw new AuthenticationUserNotFoundException();
        }

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return UserInterface::class === $class;
    }
}
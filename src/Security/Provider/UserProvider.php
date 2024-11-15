<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle\Security\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Ggbb\SymfonyUserPermissionBundle\SymfonyUserPermissionBundle;
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
        $userName = $this->container->get(SymfonyUserPermissionBundle::CONFIG_USER);
        /** @var UserLoaderInterface $userRepository */
        $userRepository = $this->entityManager->getRepository($userName);

        return $userRepository->loadUserByIdentifier($identifier);
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
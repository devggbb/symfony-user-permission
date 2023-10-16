<?php

namespace Ggbb\SymfonyUserPermission\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ggbb\SymfonyUserPermission\Entity\Interface\UserRoleFieldInterface;
use Ggbb\SymfonyUserPermission\Entity\Interface\UserRoleInterface;
use Ggbb\SymfonyUserPermission\GgbbUserPermissionBundle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[AsCommand(
    name: 'role:create-default-user-role',
    description: '',
)]
class CreateDefaultUserRoleCommand extends Command
{
    const USER_ROLES = [
        'ROLE_USER',
        'ROLE_ADMIN',
    ];

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ContainerBagInterface  $container,
        string                         $name = null)
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$this->container->has(GgbbUserPermissionBundle::CONFIG_USER)) {
            @trigger_error('Config user not found');
        }
        if (!$this->container->has(GgbbUserPermissionBundle::CONFIG_USER_ROLE)) {
            @trigger_error('Config user_role not found');
        }

        $defaultUserRole = null;
        $userRoleName = $this->container->get(GgbbUserPermissionBundle::CONFIG_USER_ROLE);
        foreach (self::USER_ROLES as $role) {
            /** @var UserRoleInterface $userRole */
            $userRole = new $userRoleName();
            $userRole->setRole($role);
            $this->entityManager->persist($userRole);
            $io->info([
                "Add role {$role}",
            ]);

            if ($userRole->getRole() === self::USER_ROLES[0]) {
                $defaultUserRole = $userRole;
            }
        }

        if (!$defaultUserRole) {
            @trigger_error('Default user_role not found');
        }

        $userName = $this->container->get(GgbbUserPermissionBundle::CONFIG_USER);
        $userRepository = $this->entityManager->getRepository($userName);
        $users = $userRepository->findBy(['userRole' => null]);
        /** @var UserRoleFieldInterface|UserInterface $user */
        foreach ($users as $user) {
            $user->setUserRole($defaultUserRole);
            $this->entityManager->persist($user);
            $io->info([
                "Add role to user {$user->getUserIdentifier()}",
            ]);
        }

        try {
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception('Error: '.$exception->getMessage());

            return Command::INVALID;
        }

        $io->success([
            "It's ok",
        ]);
        return Command::SUCCESS;
    }
}
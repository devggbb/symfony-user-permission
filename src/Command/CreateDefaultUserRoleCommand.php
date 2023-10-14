<?php

namespace Ggbb\SymfonyUserPermission\Command;

use Doctrine\ORM\EntityManagerInterface;
use Ggbb\SymfonyUserPermission\Entity\Interface\UserRoleInterface;
use Ggbb\SymfonyUserPermission\GgbbUserPermissionBundle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsCommand(
    name: 'permission:create-default-user-role',
    description: '',
)]
class CreateDefaultUserRoleCommand extends Command
{
    const USER_ROLES = [
        'ROLE_ADMIN',
        'ROLE_USER',
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
        if (!$this->container->has(GgbbUserPermissionBundle::CONFIG_USER_ROLE_REPOSITORY)) {
            @trigger_error('Config user_role_repository not found');
        }

        $userRoleName = $this->container->get(GgbbUserPermissionBundle::CONFIG_USER_ROLE_REPOSITORY);
        foreach (self::USER_ROLES as $role) {
            /** @var UserRoleInterface $userRole */
            $userRole = new $userRoleName();
            $userRole->setRole($role);
            $this->entityManager->persist($userRole);
        }

        try {
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new \Exception('Error: '.$exception->getMessage());

            return Command::INVALID;
        }

        return Command::SUCCESS;
    }
}
<?php

declare(strict_types=1);

namespace Ggbb\SymfonyUserPermissionBundle;

use Ggbb\SymfonyUserPermissionBundle\Permission\PermissionMappingGenerator;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SymfonyUserPermissionBundle extends AbstractBundle
{
    const CONFIG_USER = 'user_permission.entity.user';
    const CONFIG_USER_ROLE = 'user_permission.entity.user_role';

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('entity')
                    ->children()
                        ->scalarNode('user')->end()
                        ->scalarNode('user_role')->end()
                    ->end()
                ->end()
                ->arrayNode('mapping')
                    ->children()
                        ->scalarNode('permissions_dir')->end()
                        ->scalarNode('namespace')->end()
                    ->end()
                ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import(__DIR__ . '/../config/services.yaml');

        $container->parameters()->set(self::CONFIG_USER, $config['entity']['user']);
        $container->parameters()->set(self::CONFIG_USER_ROLE, $config['entity']['user_role']);

        $definition = $builder->getDefinition('user_permission.user_service');
        $definition->setArgument('$permissionMapping', PermissionMappingGenerator::generating($config['mapping']['namespace'], $config['mapping']['permissions_dir']));
    }
}
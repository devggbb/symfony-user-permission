<?php

namespace Ggbb\SymfonyUserPermission;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class GgbbUserPermissionBundle extends AbstractBundle
{
    const CONFIG_USER_ROLE_REPOSITORY = 'ggbb_user_permission.entity.user_role';

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('entity')
                    ->children()
                        ->scalarNode('user_role')
                    ->end()
                ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import(__DIR__ . '/../config/services.yaml');


        $containerConfigurator->parameters()->set(self::CONFIG_USER_ROLE_REPOSITORY, $config['entity']['user_role']);
    //    dd($config['user_role_repository']);
    }
}
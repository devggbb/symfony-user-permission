<?php

namespace Ggbb\SymfonyUserPermission;

use Ggbb\SymfonyUserPermission\Service\PermissionService;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class GgbbUserPermissionBundle extends AbstractBundle
{
    const CONFIG_USER = 'ggbb_user_permission.entity.user';
    const CONFIG_USER_ROLE = 'ggbb_user_permission.entity.user_role';

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
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import(__DIR__ . '/../config/services.yaml');

        $containerConfigurator->parameters()->set(self::CONFIG_USER, $config['entity']['user']);
        $containerConfigurator->parameters()->set(self::CONFIG_USER_ROLE, $config['entity']['user_role']);
        $containerBuilder->setDefinitions();
       // dump('Test');
//        /** @var PermissionService $res */
//        $res = $containerBuilder->get('ggbb.user_permission.user_service');
//       // $res1 = $containerBuilder->get(TagAwareCacheInterface::class);
//        dd($containerBuilder->get);
//
//        dump($res->isPermission('asdfasdf'));
    }
}
<?php

namespace LegitHealth\DapiBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class LegitHealthDapiBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->integerNode('api_key')->end()
            ->scalarNode('api_url')->end()
            ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.xml');

        $container->services()
            ->get('LegitHealth\DapiBundle\MediaAnalyzer')
            ->arg(0, $config['api_url'])
            ->arg(1, $config['api_key']);
    }
}

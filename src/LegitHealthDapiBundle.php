<?php

namespace LegitHealth\DapiBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class LegitHealthDapiBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->scalarNode('api_key')->end()
            ->scalarNode('api_url')->end()
            ->end()
            ->end();
    }

    public function build(ContainerBuilder $containerBuilder)
    {
        parent::build($containerBuilder);
    }

    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $containerConfigurator->import('../config/services.xml');

        $containerConfigurator->services()->set('dapi.http.client', HttpClient::class)
            ->factory([HttpClientFactory::class, 'withConfig'])
            ->args([$config['api_url'], $config['api_key']])
            ->tag('http_client.client');

        $containerConfigurator->services()
            ->get('LegitHealth\DapiBundle\MediaAnalyzer')
            ->arg(0, new Reference('dapi.http.client'));
    }
}

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
            ->scalarNode('api_key')->end()
            ->scalarNode('api_url')->end()
            ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $builder): void
    {
        $containerConfigurator->import('../config/services.xml');

        $apiUrl = $config['api_url'];
        $apiKey = $config['api_key'];

        $containerConfigurator->extension('framework', [
            'http_client' => ['scoped_clients' => [
                'dapi.http.client' => [
                    'base_uri' => $apiUrl,
                    'headers' => [
                        'x-api-key' => $apiKey
                    ]
                ]
            ]],
        ]);
    }
}

<?php

namespace LegitHealth\DapiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('legit_health_dapi');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('api_key')->end()
            ->scalarNode('api_url')->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}

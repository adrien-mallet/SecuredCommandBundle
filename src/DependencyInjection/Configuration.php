<?php

namespace SecuredContainerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('secured_container');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('unauthorized')
                ->scalarPrototype()->end()
            ->end() // unauthorized
            ->end()
        ;

        return $treeBuilder;
    }
}
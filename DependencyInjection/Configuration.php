<?php

namespace Devmachine\FormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder->root('devmachine_form');
        $root
            ->children()
                ->arrayNode('formats')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('date')
                            ->validate()
                                ->ifTrue(function ($v) {
                                    return false === strpos($v, 'y') || false === strpos($v, 'M') || false === strpos($v, 'd');
                                })
                                ->thenInvalid('Should contain the letters "y", "M" and "d".')
                            ->end()
                            ->cannotBeEmpty()->defaultValue('yyyy-MM-dd')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

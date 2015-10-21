<?php

namespace Devmachine\Bundle\FormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ScalarNodeDefinition;
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
                        ->append($this->dateNote('date', 'yyyy-MM-dd'))
                        ->append($this->dateNote('datetime', 'yyyy-MM-dd HH:mm'))
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    private function dateNote($name, $value)
    {
        $node = new ScalarNodeDefinition($name);

        return $node
            ->validate()
                ->ifTrue(function ($v) {
                    return false === strpos($v, 'y') || false === strpos($v, 'M') || false === strpos($v, 'd');
                })
                ->thenInvalid('Should contain the letters "y", "M" and "d".')
            ->end()
            ->cannotBeEmpty()
            ->defaultValue($value)
        ;
    }
}

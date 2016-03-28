<?php

namespace Plehatron\LimoncelloBundle\DependencyInjection;

use Neomerx\Limoncello\Config\Config as C;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('plehatron_limoncello');
        $rootNode
            ->children()
                ->arrayNode(C::SCHEMAS)
                    ->isRequired()
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode(C::JSON)
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode(C::JSON_OPTIONS)
                            ->defaultValue(C::JSON_OPTIONS_DEFAULT)
                        ->end()
                        ->scalarNode(C::JSON_DEPTH)
                            ->defaultValue(C::JSON_DEPTH_DEFAULT)
                        ->end()
                        ->scalarNode(C::JSON_IS_SHOW_VERSION)
                            ->defaultValue(C::JSON_IS_SHOW_VERSION_DEFAULT)
                        ->end()
                        ->scalarNode(C::JSON_VERSION_META)->end()
                        ->scalarNode(C::JSON_URL_PREFIX)->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;

        return $treeBuilder;
    }
}

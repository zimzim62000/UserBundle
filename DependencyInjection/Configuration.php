<?php

namespace ZIMZIM\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zimzim_user');

        $rootNode
            ->children()
                ->scalarNode('db_driver')->defaultValue('orm')->end()
                ->scalarNode('firewall_name')->defaultValue('main')->end()
                ->scalarNode('user_class')->defaultValue('ZIMZIM\UserBundle\Entity\User')->end()
                ->scalarNode('registration.form.type')->defaultValue('zimzim_user_registration')->end()
                ->scalarNode('profile.form.type')->defaultValue()->end('zimzim_user_profile')
            ->end();
        return $treeBuilder;
    }
}

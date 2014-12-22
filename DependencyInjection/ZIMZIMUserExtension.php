<?php

namespace ZIMZIM\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ZIMZIMUserExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias().'.db_driver', $config['db_driver']);
        $container->setParameter($this->getAlias().'.firewall_name', $config['firewall_name']);
        $container->setParameter($this->getAlias().'.user_class', $config['user_class']);
        $container->setParameter($this->getAlias().'.registration.form.type', $config['registration_form_type']);
        $container->setParameter($this->getAlias().'.profile.form.type', $config['profile_form_type']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}

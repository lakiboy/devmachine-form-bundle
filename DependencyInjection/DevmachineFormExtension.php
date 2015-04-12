<?php

namespace Devmachine\FormBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class DevmachineFormExtension extends ConfigurableExtension
{
    protected function loadInternal(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->getDefinition('devmachine_form.format_configuration')
            ->addMethodCall('setDateFormat', [$config['formats']['date']])
        ;

        if (!isset($container->getParameter('kernel.bundles')['GenemuFormBundle'])) {
            $loader->load('genemu.xml');
        }
    }
}

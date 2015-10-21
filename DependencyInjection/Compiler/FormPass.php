<?php

namespace Devmachine\FormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('twig.form.resources')) {
            return;
        }

        $resources = $container->getParameter('twig.form.resources');

        foreach (['layout', 'javascript'] as $template) {
            $resources[] = 'DevmachineFormBundle:Form:form_'.$template.'.html.twig';
        }

        $container->setParameter('twig.form.resources', $resources);
    }
}

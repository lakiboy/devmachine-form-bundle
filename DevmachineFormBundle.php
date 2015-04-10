<?php

namespace Devmachine\FormBundle;

use Devmachine\FormBundle\DependencyInjection\Compiler\FormPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DevmachineFormBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FormPass());
    }
}

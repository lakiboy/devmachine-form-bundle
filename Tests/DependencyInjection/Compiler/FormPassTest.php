<?php

namespace Devmachine\Bundle\FormBundle\Tests\DependencyInjection\Compiler;

use Devmachine\Bundle\FormBundle\DependencyInjection\Compiler\FormPass;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FormPass());
    }

    /**
     * @test
     */
    public function it_appends_twig_form_resources()
    {
        $this->setParameter('twig.form.resources', []);

        $this->compile();

        $this->assertContainerBuilderHasParameter('twig.form.resources', [
            'DevmachineFormBundle:Form:form_layout.html.twig',
            'DevmachineFormBundle:Form:form_javascript.html.twig',
        ]);
    }
}

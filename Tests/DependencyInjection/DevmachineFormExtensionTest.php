<?php

namespace Devmachine\Bundle\FormBundle\Tests\DependencyInjection;

use Devmachine\Bundle\FormBundle\DependencyInjection\DevmachineFormExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class DevmachineFormExtensionTest extends AbstractExtensionTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setParameter('kernel.bundles', []);
    }

    /**
     * @test
     */
    public function it_registers_configuration_service()
    {
        $this->load([
            'formats' => [
                'date' => 'dd/MM/y',
                'datetime' => 'dd/MM/y HH:mm',
            ],
        ]);

        $this->assertContainerBuilderHasService('devmachine_form.format_configuration', 'Devmachine\Bundle\FormBundle\FormatConfiguration');
        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'devmachine_form.format_configuration',
            'setDateFormat',
            ['dd/MM/y']
        );
        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'devmachine_form.format_configuration',
            'setDateTimeFormat',
            ['dd/MM/y HH:mm']
        );

        $this->assertContainerBuilderHasService(
            'devmachine_form.form.extension.genemu',
            'Devmachine\Bundle\FormBundle\Twig\GenemuFormExtension'
        );
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'devmachine_form.form.extension.genemu',
            'twig.extension'
        );
    }

    /**
     * @test
     */
    public function it_does_not_register_genemu_extension()
    {
        $this->setParameter('kernel.bundles', ['GenemuFormBundle' => true]);

        $this->load();

        $this->assertContainerBuilderNotHasService('devmachine_form.form.extension.genemu');
    }

    /**
     * @dataProvider getFormTypes
     *
     * @test
     *
     * @param string $serviceId
     */
    public function it_registers_form_type($serviceId)
    {
        $this->load();

        $this->assertContainerBuilderHasService($serviceId);
        $this->assertContainerBuilderHasServiceDefinitionWithTag($serviceId, 'form.type');
    }

    public function getFormTypes()
    {
        return [
            ['devmachine.form.type.date'],
            ['devmachine.form.type.datetime'],
        ];
    }

    protected function getContainerExtensions()
    {
        return [
            new DevmachineFormExtension(),
        ];
    }
}

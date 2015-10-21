<?php

namespace Devmachine\FormBundle\Tests\DependencyInjection;

use Devmachine\FormBundle\DependencyInjection\DevmachineFormExtension;
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

        $this->assertContainerBuilderHasService('devmachine_form.format_configuration', 'Devmachine\FormBundle\FormatConfiguration');
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
            'Devmachine\FormBundle\Twig\GenemuFormExtension'
        );
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            'devmachine_form.form.extension.genemu',
            'form.extension'
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
     * @param string $alias
     */
    public function it_registers_form_type($serviceId, $alias)
    {
        $this->load();

        $this->assertContainerBuilderHasService($serviceId);
        $this->assertContainerBuilderHasServiceDefinitionWithTag($serviceId, 'form.type', [
            'alias' => $alias,
        ]);
    }

    public function getFormTypes()
    {
        return [
            ['devmachine.form.type.flat_choice', 'devmachine_flat_choice'],
            ['devmachine.form.type.date', 'devmachine_date'],
            ['devmachine.form.type.datetime', 'devmachine_datetime'],
            ['devmachine.form.type.child_choice', 'devmachine_child_choice'],
            ['devmachine.form.type.typeahead', 'devmachine_typeahead'],
            ['devmachine.form.type.typeahead_country', 'devmachine_typeahead_country'],
            ['devmachine.form.type.typeahead_timezone', 'devmachine_typeahead_timezone'],
        ];
    }

    protected function getContainerExtensions()
    {
        return [
            new DevmachineFormExtension(),
        ];
    }
}

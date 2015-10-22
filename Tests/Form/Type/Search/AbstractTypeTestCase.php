<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type\Search;

use Devmachine\Bundle\FormBundle\Form\DateNormalizer;
use Devmachine\Bundle\FormBundle\Form\Type\DateTimeType;
use Devmachine\Bundle\FormBundle\Form\Type\DateType;
use Devmachine\Bundle\FormBundle\FormatConfiguration;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

abstract class AbstractTypeTestCase extends TypeTestCase
{
    protected $config;

    public function setUp()
    {
        $this->config = new FormatConfiguration();
        $this->config->setDateFormat('yyyy-MM-dd');
        $this->config->setDateTimeFormat('yyyy-MM-dd HH:mm');

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_has_valid_defaults()
    {
        $form = $this->factory->create($this->getFormType());

        $this->assertFalse($form['startDate']->getConfig()->getOption('required'));
        $this->assertFalse($form['endDate']->getConfig()->getOption('required'));
        $this->assertEquals('range.label.start_date', $form['startDate']->getConfig()->getOption('label'));
        $this->assertEquals('range.label.end_date', $form['endDate']->getConfig()->getOption('label'));
    }

    /**
     * @test
     */
    public function it_supports_custom_options()
    {
        $form = $this->factory->create($this->getFormType(), null, [
            'start_options' => [
                'label' => 'custom_start_label',
                'required' => true,
            ],
            'end_options' => [
                'label' => 'custom_end_label',
                'required' => true,
            ],
        ]);

        $this->assertTrue($form['startDate']->getConfig()->getOption('required'));
        $this->assertTrue($form['endDate']->getConfig()->getOption('required'));
        $this->assertEquals('custom_start_label', $form['startDate']->getConfig()->getOption('label'));
        $this->assertEquals('custom_end_label', $form['endDate']->getConfig()->getOption('label'));
    }

    abstract protected function getFormType();

    protected function getExtensions()
    {
        $date = new DateType($this->config, new DateNormalizer());
        $datetime = new DateTimeType($this->config);

        $types = [
            $date->getName()     => $date,
            $datetime->getName() => $datetime,
        ];

        return [
            new PreloadedExtension($types, []),
        ];
    }
}

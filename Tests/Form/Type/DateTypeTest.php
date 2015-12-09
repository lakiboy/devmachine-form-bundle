<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\DateNormalizer;
use Devmachine\Bundle\FormBundle\Form\Type\DateType;
use Devmachine\Bundle\FormBundle\FormatConfiguration;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class DateTypeTest extends TypeTestCase
{
    /**
     * @var FormatConfiguration
     */
    private $config;

    protected function getExtensions()
    {
        $this->config = new FormatConfiguration();
        $this->config->setDateFormat('y-MM-dd');

        $date = new DateType($this->config, new DateNormalizer());

        return [new PreloadedExtension([$date], [])];
    }

    /**
     * @test
     */
    public function it_normalizes_config()
    {
        $form = $this->factory->create(DateType::class, null, [
            'locale' => 'en_GB',
            'config' => [
                'orientation' => 'right',
                'autoclose' => true,
            ],
        ]);

        $this->assertEquals([
            'language'     => 'en',
            'format'       => 'yyyy-mm-dd',
            'orientation'  => 'right',
            'autoclose'    => true,
        ], $form->getConfig()->getOption('config'));
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Config option 'multiday' is not supported yet.
     */
    public function it_does_not_support_multidate_config_option()
    {
        $this->factory->create(DateType::class, null, [
            'config' => [
                'multidate' => true,
            ],
        ]);
    }

    /**
     * @test
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Config option 'inputs' is not supported yet.
     */
    public function it_does_not_support_inputs_config_option()
    {
        $this->factory->create(DateType::class, null, [
            'config' => [
                'inputs' => ['#foo', '#bar'],
            ],
        ]);
    }

    /**
     * @test
     */
    public function it_uses_date_format_from_config()
    {
        $this->config->setDateFormat('y-M-d');

        $form = $this->factory->create(DateType::class);

        $this->assertEquals('y-M-d', $form->getConfig()->getOption('format'));
    }

    /**
     * @test
     */
    public function it_uses_bootstrap_converter()
    {
        $form = $this->factory->create(DateType::class);

        $formatter = $form->getConfig()->getOption('formatter');

        $this->assertInstanceOf('Devmachine\Bundle\FormBundle\Converter\BootstrapFormatConverter', $formatter);
        $this->assertTrue(is_callable($formatter));
    }

    /**
     * @test
     */
    public function it_creates_valid_view()
    {
        $form = $this->factory->create(DateType::class, null, [
            'input_addon' => true,
            'config' => [
                'autoclose' => true,
            ],
        ]);
        $view = $form->createView();

        $this->assertTrue($view->vars['input_addon']);
        $this->assertFalse($view->vars['inline']);
        $this->assertEquals([
            'language'  => 'en',
            'format'    => 'yyyy-mm-dd',
            'autoclose' => true,
        ], $view->vars['config']);

        $this->assertArrayNotHasKey('startDate', $view->vars['config']);
        $this->assertArrayNotHasKey('endDate', $view->vars['config']);
        $this->assertArrayNotHasKey('datesDisabled', $view->vars['config']);
    }

    /**
     * @test
     */
    public function it_submits_form()
    {
        $form = $this->factory->create(DateType::class);

        $form->submit('1983-01-20');

        $this->assertTrue($form->isSynchronized());

        $this->assertInstanceOf('DateTime', $form->getData());
        $this->assertEquals('1983-01-20', $form->getData()->format('Y-m-d'));
    }

    /**
     * @test
     */
    public function it_normalizes_date_options_in_config()
    {
        $form = $this->factory->create(DateType::class, null, [
            'config' => [
                'startDate'     => '2014-09-21',
                'endDate'       => \DateTime::createFromFormat('Y-m-d', '2015-09-24'),
                'datesDisabled' => [
                    '1983-01-20',
                    \DateTime::createFromFormat('Y-m-d', '1989-04-05'),
                ],
            ],
        ]);

        $view = $form->createView();

        $this->assertArrayHasKey('startDate', $view->vars['config']);
        $this->assertArrayHasKey('endDate', $view->vars['config']);
        $this->assertArrayHasKey('datesDisabled', $view->vars['config']);

        $this->assertEquals('2014-09-21', $view->vars['config']['startDate']);
        $this->assertEquals('2015-09-24', $view->vars['config']['endDate']);
        $this->assertEquals('1983-01-20', $view->vars['config']['datesDisabled'][0]);
        $this->assertEquals('1989-04-05', $view->vars['config']['datesDisabled'][1]);
    }
}

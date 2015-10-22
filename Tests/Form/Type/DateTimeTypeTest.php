<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\DateTimeType;
use Devmachine\Bundle\FormBundle\FormatConfiguration;
use Symfony\Component\Form\Test\TypeTestCase;

class DateTimeTypeTest extends TypeTestCase
{
    private $dateType;

    public function setUp()
    {
        parent::setUp();

        $config = new FormatConfiguration();
        $config->setDateTimeFormat('y-MM-dd HH:mm');

        $this->dateType = new DateTimeType($config);
    }

    /**
     * @test
     */
    public function it_normalizes_config()
    {
        $form = $this->factory->create($this->dateType, null, [
            'locale' => 'en_GB',
            'config' => [
                'stepping' => 5,
                'keepOpen' => true,
            ],
        ]);

        $this->assertEquals([
            'locale'   => 'en_GB',
            'format'   => 'YYYY-MM-DD HH:mm',
            'stepping' => 5,
            'keepOpen' => true,
        ], $form->getConfig()->getOption('config'));
    }

    /**
     * @test
     */
    public function it_uses_datetime_format_from_config()
    {
        $config = $this->getMock('Devmachine\Bundle\FormBundle\FormatConfiguration');
        $config
            ->expects($this->once())
            ->method('getDateTimeFormat')
            ->willReturn('y-MM-dd HH:mm')
        ;

        $form = $this->factory->create(new DateTimeType($config), null, [
            'config' => [
                'dayViewHeaderFormat' => 'dd/MM/y',
            ],
        ]);

        $this->assertEquals('y-MM-dd HH:mm', $form->getConfig()->getOption('format'));
    }

    /**
     * @test
     */
    public function it_uses_momentjs_converter()
    {
        $form = $this->factory->create($this->dateType);

        $formatter = $form->getConfig()->getOption('formatter');

        $this->assertInstanceOf('Devmachine\Bundle\FormBundle\Converter\MomentJsFormatConverter', $formatter);
        $this->assertTrue(is_callable($formatter));
    }

    /**
     * @test
     */
    public function it_creates_valid_view()
    {
        $form = $this->factory->create($this->dateType, null, [
            'locale' => 'en_GB',
            'input_addon' => true,
            'config' => [
                'showClear' => true,
            ],
        ]);

        $view = $form->createView();

        $this->assertTrue($view->vars['input_addon']);
        $this->assertFalse($view->vars['inline']);
        $this->assertEquals([
            'locale'    => 'en_GB',
            'format'    => 'YYYY-MM-DD HH:mm',
            'showClear' => true,
        ], $view->vars['config']);
    }

    /**
     * @test
     */
    public function it_submits_form()
    {
        $form = $this->factory->create($this->dateType);

        $form->submit('1983-01-20 06:10');

        $this->assertTrue($form->isSynchronized());

        $this->assertInstanceOf('DateTime', $form->getData());
        $this->assertEquals('1983-01-20 06:10', $form->getData()->format('Y-m-d H:i'));
    }

    /**
     * @test
     */
    public function it_normalizes_date_options_in_config()
    {
        $form = $this->factory->create($this->dateType, null, [
            'config' => [
                'minDate'       => '2014-09-21',
                'maxDate'       => \DateTime::createFromFormat('Y-m-d', '2015-09-24'),
                'enabledDates'  => [
                    '1983-01-20',
                    \DateTime::createFromFormat('Y-m-d', '1989-04-05'),
                ],
                'disabledDates' => [
                    \DateTime::createFromFormat('Y-m-d', '1983-01-20'),
                    '1989-04-05',
                ],
            ],
        ]);

        $view = $form->createView();

        $this->assertArrayHasKey('minDate', $view->vars['config']);
        $this->assertArrayHasKey('maxDate', $view->vars['config']);
        $this->assertArrayHasKey('enabledDates', $view->vars['config']);
        $this->assertArrayHasKey('disabledDates', $view->vars['config']);

        $this->assertEquals('2014-09-21', $view->vars['config']['minDate']);
        $this->assertEquals('2015-09-24', $view->vars['config']['maxDate']);
        $this->assertEquals('1983-01-20', $view->vars['config']['enabledDates'][0]);
        $this->assertEquals('1989-04-05', $view->vars['config']['enabledDates'][1]);
        $this->assertEquals('1983-01-20', $view->vars['config']['disabledDates'][0]);
        $this->assertEquals('1989-04-05', $view->vars['config']['disabledDates'][1]);
    }
}

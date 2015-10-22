<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadType;
use Symfony\Component\Form\Test\TypeTestCase;

class TypeaheadTypeTest extends TypeTestCase
{
    /**
     * @test
     *
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     * @expectedExceptionMessage The required option "name" is missing.
     */
    public function it_requires_name_option()
    {
        $this->factory->create(new TypeaheadType());
    }

    /**
     * @test
     */
    public function it_submits_with_simple_source()
    {
        $form = $this->factory->create(new TypeaheadType(), null, [
            'name'   => 'test',
            'source' => ['Foo', 'Bar', 'Baz'],
        ]);

        $form->submit('Bar');

        $this->assertTrue($form->isSynchronized());
        $this->assertSame('Bar', $form->getViewData());
    }

    /**
     * @test
     */
    public function it_normalizes_config()
    {
        $form = $this->factory->create(new TypeaheadType(), null, [
            'name'        => 'test',
            'min_length'  => 2,
            'highlight'   => false,
            'hint'        => true,
            'class_names' => ['foo-class', 'bar-class'],
        ]);

        $this->assertEquals([
            'minLength'  => 2,
            'highlight'  => false,
            'hint'       => true,
            'classNames' => ['foo-class', 'bar-class'],
        ], $form->getConfig()->getOption('config'));
    }

    /**
     * @test
     */
    public function it_normalizes_attrs()
    {
        $form = $this->factory->create(new TypeaheadType(), null, [
            'name' => 'test',
            'placeholder' => 'Select test',
        ]);

        $this->assertEquals([
            'placeholder' => 'Select test',
        ], $form->getConfig()->getOption('attr'));
    }

    /**
     * @test
     */
    public function it_creates_valid_view()
    {
        $form = $this->factory->create(new TypeaheadType(), null, [
            'name'         => 'test',
            'source'       => ['Foo', 'Bar', 'Baz'],
            'route_name'   => 'test_view',
            'route_params' => ['id' => 'item'],
            'matcher'      => 'starts_with',
        ]);
        $view = $form->submit('Baz')->createView();

        $this->assertTrue($form->isSynchronized());

        $this->assertArrayHasKey('config', $view->vars);
        $this->assertArrayHasKey('name', $view->vars);
        $this->assertArrayHasKey('source', $view->vars);
        $this->assertArrayHasKey('limit', $view->vars);
        $this->assertArrayHasKey('value_key', $view->vars);
        $this->assertArrayHasKey('label_key', $view->vars);
        $this->assertArrayHasKey('matcher', $view->vars);
        $this->assertArrayHasKey('route_name', $view->vars);
        $this->assertArrayHasKey('route_params', $view->vars);
        $this->assertArrayHasKey('typeahead_value', $view->vars);

        $this->assertEquals(['hint' => true, 'highlight' => true, 'minLength' => 3], $view->vars['config']);
        $this->assertEquals('test', $view->vars['name']);
        $this->assertEquals(['Foo', 'Bar', 'Baz'], $view->vars['source']);
        $this->assertEquals(5, $view->vars['limit']);
        $this->assertNull($view->vars['value_key']);
        $this->assertNull($view->vars['label_key']);
        $this->assertEquals('startsWith', $view->vars['matcher']);
        $this->assertEquals('test_view', $view->vars['route_name']);
        $this->assertEquals(['id' => 'item'], $view->vars['route_params']);
        $this->assertEquals('Baz', $view->vars['typeahead_value']);
    }

    /**
     * @test
     */
    public function it_supports_non_scalar_sources()
    {
        $form = $this->factory->create(new TypeaheadType(), null, [
            'name' => 'test',
            'value_key' => 'id',
            'label_key' => 'city',
            'source' => [
                [
                    'id' => 1,
                    'city' => 'London',
                    'country' => 'UK',
                ],
                [
                    'id' => 2,
                    'city' => 'Riga',
                    'country' => 'LV',
                ],
                [
                    'id' => 3,
                    'city' => 'New York',
                    'country' => 'US',
                ],
            ],
        ]);

        $view = $form->submit(2)->createView();

        $this->assertTrue($form->isSynchronized());

        $this->assertArrayHasKey('value_key', $view->vars);
        $this->assertArrayHasKey('label_key', $view->vars);
        $this->assertEquals('id', $view->vars['value_key']);
        $this->assertEquals('city', $view->vars['label_key']);
        $this->assertSame('2', $view->vars['value']);
        $this->assertEquals('Riga', $view->vars['typeahead_value']);
    }
}

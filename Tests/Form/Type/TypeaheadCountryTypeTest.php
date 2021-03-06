<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadCountryType;
use Symfony\Component\Form\Test\TypeTestCase;

class TypeaheadCountryTypeTest extends TypeTestCase
{
    /**
     * @test
     */
    public function it_submits_form()
    {
        $form = $this->factory->create(TypeaheadCountryType::class, [
            'locale' => 'en',
        ]);

        $view = $form->submit('LV')->createView();

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals('LV', $form->getViewData());
        $this->assertEquals('countries', $view->vars['source_name']);

        $this->assertEquals('id', $view->vars['value_key']);
        $this->assertEquals('name', $view->vars['label_key']);
        $this->assertEquals('LV', $view->vars['value']);
        $this->assertEquals('Latvia', $view->vars['typeahead_value']);
    }
}

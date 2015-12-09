<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadTimezoneType;
use Symfony\Component\Form\Test\TypeTestCase;

class TypeaheadTimezoneTypeTest extends TypeTestCase
{
    /**
     * @test
     */
    public function it_submits_form()
    {
        $form = $this->factory->create(TypeaheadTimezoneType::class);

        $view = $form->submit('Europe/Riga')->createView();

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals('Europe/Riga', $form->getViewData());
        $this->assertEquals('timezones', $view->vars['source_name']);
    }
}

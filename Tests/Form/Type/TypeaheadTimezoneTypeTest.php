<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadTimezoneType;
use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class TypeaheadTimezoneTypeTest extends TypeTestCase
{
    /**
     * @test
     */
    public function it_submits_form()
    {
        $form = $this->factory->create(new TypeaheadTimezoneType());

        $view = $form->submit('Europe/Riga')->createView();

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals('Europe/Riga', $form->getViewData());
        $this->assertEquals('timezones', $view->vars['source_name']);
    }

    protected function getExtensions()
    {
        $typeahead = new TypeaheadType();

        $types = [
            $typeahead->getName() => $typeahead,
        ];

        return [
            new PreloadedExtension($types, []),
        ];
    }
}

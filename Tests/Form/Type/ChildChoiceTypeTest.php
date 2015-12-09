<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\ChildChoiceType;
use Symfony\Component\Form\Test\TypeTestCase;

class ChildChoiceTypeTest extends TypeTestCase
{
    /**
     * @test
     *
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     * @expectedExceptionMessage The required option "parent" is missing.
     */
    public function it_requires_parent_option()
    {
        $this->factory->create(ChildChoiceType::class, null, ['group_by' => 'foo']);
    }

    /**
     * @test
     */
    public function it_creates_valid_view()
    {
        $form = $this->factory->create(ChildChoiceType::class, null, [
            'parent'   => 'parent',
            'group_by' => 'country',
            'select2'  => true,
        ]);

        $view = $form->createView();

        $this->assertEquals('parent', $view->vars['parent']);
        $this->assertTrue($view->vars['select2']);
    }
}

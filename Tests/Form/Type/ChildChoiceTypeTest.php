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
        $this->factory->create(new ChildChoiceType());
    }

    /**
     * Exception is InvalidOptionsException, because "choice" type sets "group_by" to "null" by default.
     *
     * @test
     *
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function it_requires_group_by_option()
    {
        $this->factory->create(new ChildChoiceType(), null, ['parent' => 'foo']);
    }

    /**
     * @test
     */
    public function it_creates_valid_view()
    {
        $form = $this->factory->create(new ChildChoiceType(), null, [
            'parent'   => 'parent',
            'group_by' => 'country',
            'select2'  => true,
        ]);

        $view = $form->createView();

        $this->assertEquals($view->vars['parent'], 'parent');
        $this->assertTrue($view->vars['select2']);
    }
}

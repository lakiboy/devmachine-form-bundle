<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\FlatChoiceType;
use Symfony\Component\Form\Test\TypeTestCase;

class FlatChoiceTypeTest extends TypeTestCase
{
    /**
     * @dataProvider getData
     *
     * @test
     *
     * @param string $separator
     * @param string $value
     * @param array  $data
     */
    public function it_submits_with_valid_data($separator, $value, $data)
    {
        $form = $this->factory->create(FlatChoiceType::class, null, ['separator' => $separator]);

        $form->submit($value);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($data, $form->getData());
        $this->assertEmpty($form->createView()->children);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            [', ', 'foo, bar, baz', ['foo', 'bar', 'baz']],
            ['|', 'a|b|c', ['a', 'b', 'c']],
        ];
    }
}

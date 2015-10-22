<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\DataTransformer;

use Devmachine\Bundle\FormBundle\Form\DataTransformer\ArrayToStringTransformer;

class ArrayToStringTransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_transforms_array_to_string()
    {
        $array = ['foo', 'bar', 'baz'];

        $this->assertSame('', (new ArrayToStringTransformer())->transform(null));
        $this->assertEquals('foo, bar, baz', (new ArrayToStringTransformer())->transform($array));
        $this->assertEquals('foo|bar|baz', (new ArrayToStringTransformer('|'))->transform($array));
    }

    /**
     * @test
     *
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     * @expectedExceptionMessage Expected array, got stdClass
     */
    public function it_throws_exception_on_invalid_array_to_string_transformation()
    {
        (new ArrayToStringTransformer())->transform(new \stdClass());
    }

    /**
     * @test
     */
    public function it_transforms_string_to_array()
    {
        $array = ['foo', 'bar', 'baz'];

        $this->assertNull((new ArrayToStringTransformer())->reverseTransform(null));
        $this->assertNull((new ArrayToStringTransformer())->reverseTransform(''));
        $this->assertEquals($array, (new ArrayToStringTransformer())->reverseTransform('foo, bar, baz'));
        $this->assertEquals($array, (new ArrayToStringTransformer('|'))->reverseTransform('foo|bar|baz'));
    }

    /**
     * @test
     *
     * @expectedException \Symfony\Component\Form\Exception\TransformationFailedException
     * @expectedExceptionMessage Expected string, got integer
     */
    public function it_throws_exception_on_invalid_string_to_array_transformation()
    {
        (new ArrayToStringTransformer())->reverseTransform(1);
    }
}

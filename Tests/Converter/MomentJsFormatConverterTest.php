<?php

namespace Devmachine\Bundle\FormBundle\Tests\Converter;

use Devmachine\Bundle\FormBundle\Converter\MomentJsFormatConverter;

class MomentJsFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @dataProvider getPatterns
     *
     * @param string $intl
     * @param string $expected
     */
    public function it_converts_format($intl, $expected)
    {
        $converter = new MomentJsFormatConverter('ru', 'Europe/Riga');

        $this->assertEquals($expected, $converter->convert($intl));
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            ['yyyy-MM-dd', 'YYYY-MM-DD'],
            ['d/MMMM/y hha m ss Q D', 'D/MMMM/YYYY hha m ss Q DDD'],
        ];
    }
}

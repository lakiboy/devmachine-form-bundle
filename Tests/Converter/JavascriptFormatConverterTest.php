<?php

namespace Devmachine\FormBundle\Tests\Converter;

use Devmachine\FormBundle\Converter\JavascriptFormatConverter;

class JavascriptFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     *
     * @dataProvider getPatterns
     *
     * @param string $format
     * @param string $expected
     */
    public function it_converts_format($format, $expected)
    {
        $converter = new JavascriptFormatConverter('en_GB', 'Europe/London');
        $converter->setSymbolsMap([
            'yyyy' => '1111',
            'yyy'  => '222',
            'yy'   => '33',
            'y'    => '4',

            'mmmm' => '5555',
            'mmm'  => '666',
            'mm'   => '77',
            'm'    => '8',

            'dd'   => '99',
            'd'    => '0',

            'MMM'  => '!',
        ]);

        $this->assertEquals($expected, $converter->convert($format));
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            ['yy-mm-dd', '33-77-99'],
            ['y-m-d', '4-8-0'],
            ['dd/mmm/yyy', '99/666/222'],
            ['DD-mm-Y', 'DD-77-Y'],
            ['ddddd mmmmm yyyyy', '99990 55558 11114'],
        ];
    }
}

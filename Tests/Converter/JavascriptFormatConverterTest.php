<?php

namespace Devmachine\FormBundle\Tests\Converter;

use Devmachine\FormBundle\Converter\JavascriptFormatConverter;

class JavascriptFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var JavascriptFormatConverter */
    private $converter;

    public function setUp()
    {
        $this->converter = new JavascriptFormatConverter('en_GB', 'Europe/London');
    }

    /**
     * @dataProvider getConversions
     *
     * @param string $format
     * @param string $converted
     */
    public function testConvert($format, $converted)
    {
        $this->converter->setSymbolsMap([
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
        ]);

        $this->assertEquals($converted, $this->converter->convert($format));
    }

    /**
     * @return array
     */
    public function getConversions()
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

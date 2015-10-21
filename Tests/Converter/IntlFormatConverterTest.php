<?php

namespace Devmachine\FormBundle\Tests\Converter;

use Devmachine\FormBundle\Converter\IntlFormatConverter;
use IntlDateFormatter;

class IntlFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_is_callable()
    {
        $this->assertTrue(is_callable(new PassThroughFormatConverter('en')));
    }

    /**
     * @test
     *
     * @dataProvider getFormats
     *
     * @param int|string $dateFormat
     * @param int        $timeFormat
     * @param string     $expected
     */
    public function it_detects_proper_format($dateFormat, $timeFormat, $expected)
    {
        $converter = new PassThroughFormatConverter('en');

        $this->assertEquals($expected, $converter->convert($dateFormat, $timeFormat));
        $this->assertEquals($expected, $converter($dateFormat, $timeFormat));
    }

    public function getFormats()
    {
        return [
            [IntlDateFormatter::MEDIUM, IntlDateFormatter::NONE, 'MMM d, y'],
            [IntlDateFormatter::NONE, IntlDateFormatter::MEDIUM, 'h:mm:ss a'],
            ['YYYY-mm-dd', IntlDateFormatter::NONE, 'YYYY-mm-dd'],
            ['YYYY-mm-dd HH:mm', IntlDateFormatter::NONE, 'YYYY-mm-dd HH:mm'],
        ];
    }
}

class PassThroughFormatConverter extends IntlFormatConverter
{
    protected function format($pattern)
    {
        return $pattern;
    }
}

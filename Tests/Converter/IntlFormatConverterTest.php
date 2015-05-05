<?php

namespace Devmachine\FormBundle\Tests\Converter;

use Devmachine\FormBundle\Converter\IntlFormatConverter;
use IntlDateFormatter;

class IntlFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $converter = new PassThroughFormatConverter('en_GB', 'Europe/London');
        $this->assertTrue(is_callable($converter));

        return $converter;
    }

    /**
     * @depends testConstructor
     */
    public function testConvertByDateFormat(IntlFormatConverter $converter)
    {
        $this->assertEquals('d MMM y', $converter->convert(IntlDateFormatter::MEDIUM));
        $this->assertEquals('d MMM y', $converter(IntlDateFormatter::MEDIUM));
    }

    /**
     * @depends testConstructor
     */
    public function testConvertByDateTimeFormat(IntlFormatConverter $converter)
    {
        $this->assertEquals('d MMM y, HH:mm:ss', $converter->convert(IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM));
        $this->assertEquals('d MMM y, HH:mm:ss', $converter(IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM));
    }

    /**
     * @depends testConstructor
     */
    public function testConvertByCustomFormat(IntlFormatConverter $converter)
    {
        $this->assertEquals('YYYY-mm-dd', $converter->convert('YYYY-mm-dd'));
        $this->assertEquals('YYYY-mm-dd', $converter('YYYY-mm-dd'));
    }
}

class PassThroughFormatConverter extends IntlFormatConverter
{
    protected function format($pattern)
    {
        return $pattern;
    }
}

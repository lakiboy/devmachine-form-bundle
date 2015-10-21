<?php

namespace Devmachine\Bundle\FormBundle\Tests\Converter;

use Devmachine\Bundle\FormBundle\Converter\BootstrapFormatConverter;

class BootstrapFormatConverterTest extends \PHPUnit_Framework_TestCase
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
        $converter = new BootstrapFormatConverter('en_GB', 'Europe/Riga');

        $this->assertEquals($expected, $converter->convert($intl));
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            ['yyyy-MM-dd', 'yyyy-mm-dd'],
            ['d/MMM/y', 'd/M/yyyy'],
            ['dd/MMMMM/yy', 'dd/M/yy'],
        ];
    }
}

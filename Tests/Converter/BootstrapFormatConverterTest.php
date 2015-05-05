<?php

namespace Devmachine\FormBundle\Tests\Converter;

use Devmachine\FormBundle\Converter\BootstrapFormatConverter;

class BootstrapFormatConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getPatterns
     *
     * @param string $intl
     * @param string $bootstrap
     */
    public function testConvert($intl, $bootstrap)
    {
        $converter = new BootstrapFormatConverter('ru', 'Europe/Riga');

        $this->assertEquals($bootstrap, $converter->convert($intl));
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            ['yyyy-MM-dd', 'yyyy-mm-dd'],
            ['d/MMM/y', 'd/M/yyyy'],
        ];
    }
}

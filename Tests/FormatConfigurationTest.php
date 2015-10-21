<?php

namespace Devmachine\Bundle\FormBundle\Tests;

use Devmachine\Bundle\FormBundle\FormatConfiguration;

class FormatConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_holds_config()
    {
        $config = new FormatConfiguration();
        $config->setDateFormat('Y-m-d');
        $config->setDateTimeFormat('Y-m-d H:i:s');

        $this->assertEquals('Y-m-d', $config->getDateFormat());
        $this->assertEquals('Y-m-d H:i:s', $config->getDateTimeFormat());
    }
}

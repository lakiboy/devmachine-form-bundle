<?php

namespace Devmachine\Bundle\FormBundle\Tests\DependencyInjection;

use Devmachine\Bundle\FormBundle\DependencyInjection\Configuration;
use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration()
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function it_accepts_empty_config()
    {
        $config = [];
        $this->assertProcessedConfigurationEquals([$config], [
            'formats' => [
                'date'     => 'yyyy-MM-dd',
                'datetime' => 'yyyy-MM-dd HH:mm',
            ],
        ]);
    }

    /**
     * @test
     */
    public function it_accepts_formats()
    {
        $config = [
            'formats' => [
                'date'     => 'd/MM/y',
                'datetime' => 'd/MM/y HH:mm',
            ],
        ];
        $this->assertProcessedConfigurationEquals([$config], [
            'formats' => [
                'date'     => 'd/MM/y',
                'datetime' => 'd/MM/y HH:mm',
            ],
        ]);
    }

    /**
     * @test
     */
    public function it_does_not_accept_invalid_format()
    {
        $config = [
            'formats' => [
                'date' => 'd/y',
            ],
        ];
        $this->assertConfigurationIsInvalid([$config], 'Should contain the letters "y", "M" and "d".');
    }
}

<?php

namespace Devmachine\FormBundle\Tests\Form;

use Devmachine\FormBundle\Form\DateNormalizer;

class DateNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /** @var DateNormalizer */
    private $normalizer;

    public function setUp()
    {
        $this->normalizer = new DateNormalizer();
    }

    /**
     * @test
     */
    public function it_leaves_non_datetime_type_intact()
    {
        $dummy = new \stdClass();
        $this->assertSame($dummy, $this->normalizer->normalizeDate($dummy, $this->getMock('Symfony\Component\Form\FormInterface')));
    }

    /**
     * @test
     */
    public function it_normalized_date()
    {
        $date              = new \DateTime();
        $datePreNormalized = new \DateTime();
        $dateNormalized    = new \DateTime();

        $transformer1 = $this->getMock('Symfony\Component\Form\DataTransformerInterface');
        $transformer2 = $this->getMock('Symfony\Component\Form\DataTransformerInterface');

        $transformer1
            ->expects($this->once())
            ->method('transform')
            ->with($this->identicalTo($date))
            ->willReturn($datePreNormalized)
        ;
        $transformer2
            ->expects($this->once())
            ->method('transform')
            ->with($this->identicalTo($datePreNormalized))
            ->willReturn($dateNormalized)
        ;

        $result = $this->normalizer->normalizeDate($date, $this->getForm([$transformer1, $transformer2]));
        $this->assertSame($dateNormalized, $result);
    }

    /**
     * @param array $transformers
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getForm(array $transformers)
    {
        $config = $this->getMock('Symfony\Component\Form\FormConfigInterface');
        $config
            ->expects($this->once())
            ->method('getViewTransformers')
            ->willReturn($transformers)
        ;

        $form = $this->getMock('Symfony\Component\Form\FormInterface');
        $form
            ->expects($this->once())
            ->method('getConfig')
            ->willReturn($config)
        ;

        return $form;
    }
}

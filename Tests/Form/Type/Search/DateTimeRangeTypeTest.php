<?php

namespace Devmachine\Bundle\FormBundle\Tests\Form\Type\Search;

use Devmachine\Bundle\FormBundle\Form\Type\Search\DateTimeRangeType;

class DateTimeRangeTypeTest extends AbstractTypeTestCase
{
    /**
     * @test
     */
    public function it_submits_with_valid_data()
    {
        $form = $this->factory->create($this->getFormType());

        $submittedData = [
            'startDate' => '1983-01-20 06:10',
            'endDate' => '1989-04-05 14:30',
        ];
        $data = $form->submit($submittedData)->getData();

        $this->assertTrue($form->isSynchronized());

        $this->assertInstanceOf('DateTime', $data['startDate']);
        $this->assertInstanceOf('DateTime', $data['endDate']);
        $this->assertEquals($submittedData['startDate'], $data['startDate']->format('Y-m-d H:i'));
        $this->assertEquals($submittedData['endDate'], $data['endDate']->format('Y-m-d H:i'));
    }

    protected function getFormType()
    {
        return DateTimeRangeType::class;
    }
}

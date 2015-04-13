<?php

namespace Devmachine\FormBundle\Form\Search\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateRangeType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_search_range_date';
    }

    public function getParent()
    {
        return 'devmachine_search_range';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Devmachine\FormBundle\Form\Search\Model\DateRange',
            'value_type' => 'devmachine_date',
        ]);
    }
}

<?php

namespace Devmachine\Bundle\FormBundle\Form\Type\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeRangeType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_search_range_datetime';
    }

    public function getParent()
    {
        return 'devmachine_search_range_date';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'value_type' => 'devmachine_datetime',
        ]);
    }
}

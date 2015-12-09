<?php

namespace Devmachine\Bundle\FormBundle\Form\Type\Search;

use Devmachine\Bundle\FormBundle\Form\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeRangeType extends AbstractType
{
    public function getParent()
    {
        return DateRangeType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'value_type' => DateTimeType::class,
        ]);
    }
}

<?php

namespace Devmachine\FormBundle\Form\Search\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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

    /**
     * BC.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /* @var \Symfony\Component\OptionsResolver\OptionsResolver $resolver */
        $this->configureOptions($resolver);
    }
}

<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeaheadTimezoneType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_typeahead_timezone';
    }

    public function getParent()
    {
        return 'devmachine_typeahead';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'placeholder' => 'Timezones',
            'source_name' => 'timezones',
            'min_length'  => 1,
            'limit'       => 10,
            'source'      => \DateTimeZone::listIdentifiers(),
        ]);
    }

    /**
     * BC for Symfony <2.7.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }
}

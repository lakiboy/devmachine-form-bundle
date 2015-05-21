<?php

namespace Devmachine\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            'name'        => 'timezones',
            'min_length'  => 1,
            'limit'       => 10,
            'source'      => \DateTimeZone::listIdentifiers(),
        ]);
    }
}

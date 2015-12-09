<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeaheadTimezoneType extends AbstractType
{
    public function getParent()
    {
        return TypeaheadType::class;
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
}

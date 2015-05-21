<?php

namespace Devmachine\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeaheadCountryType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_typeahead_country';
    }

    public function getParent()
    {
        return 'devmachine_typeahead';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $source = function (Options $options, $config) {
            foreach (Intl::getRegionBundle()->getCountryNames($options['locale']) as $key => $val) {
                $config[] = [$options['key'] => $key, $options['property'] => $val];
            }

            return $config;
        };

        $resolver->setDefaults([
            'placeholder' => 'Countries',
            'name'        => 'countries',
            'min_length'  => 1,
            'limit'       => 10,
            'key'         => 'id',
            'property'    => 'name',
            'locale'      => \Locale::getDefault(),
        ]);
        $resolver->setNormalizer('source', $source);
    }
}

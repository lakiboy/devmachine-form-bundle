<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            $k = $options['value_key'];
            $v = $options['label_key'];

            foreach (Intl::getRegionBundle()->getCountryNames($options['locale']) as $key => $val) {
                $config[] = [$k => $key, $v => $val];
            }

            return $config;
        };

        $resolver->setDefaults([
            'placeholder' => 'Countries',
            'source_name' => 'countries',
            'min_length'  => 1,
            'limit'       => 10,
            'value_key'   => 'id',
            'label_key'   => 'name',
            'matcher'     => 'starts_with',
            'locale'      => \Locale::getDefault(),
        ]);
        $resolver->setNormalizer('source', $source);
    }

    /**
     * BC for Symfony <2.7.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }
}

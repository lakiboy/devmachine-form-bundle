<?php

namespace AppBundle\Form\Type;

use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeaheadLanguageType extends AbstractType
{
    public function getParent()
    {
        return TypeaheadType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'source_name' => 'languages',
            'route_name'  => 'typeahead_search',
            'min_length'  => 2,
            'limit'       => 10,
            'label_key'   => 'val',
            'value_key'   => 'key',
            'required'    => false,
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $data = Intl::getLanguageBundle()->getLanguageNames();

        /*
         * When data is set, fetch the value from data source.
         *
         * For Doctrine:
         *  - inject a repository,
         *  - find entity by value e.g. id,
         *  - use appropriate property as display value.
         */
        if ($view->vars['value'] && isset($data[$view->vars['value']])) {
            $view->vars['typeahead_value'] = $data[$view->vars['value']];
        }
    }
}

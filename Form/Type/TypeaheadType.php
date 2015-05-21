<?php

namespace Devmachine\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class TypeaheadType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_typeahead';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'hint'        => true,
            'highlight'   => true,
            'min_length'  => 3,
            'class_names' => [],
            'config'      => [],
            'source'      => [],
            'limit'       => 5,
            'matcher'     => 'substring',
            'property'    => null,
            'key'         => null,
            'compound'    => false,
            'placeholder' => null,
        ]);

        $config = function (Options $options, $config) {
            if (!isset($config['hint'])) {
                $config['hint'] = $options['hint'];
            }
            if (!isset($config['highlight'])) {
                $config['highlight'] = $options['highlight'];
            }
            if (!isset($config['minLength'])) {
                $config['minLength'] = $options['min_length'];
            }
            if (!isset($config['classNames']) && count($options['class_names'])) {
                $config['classNames'] = $options['class_names'];
            }

            return $config;
        };
        $attr = function (Options $options, $attr) {
            if (isset($options['placeholder'])) {
                $attr['placeholder'] = $options['placeholder'];
            }

            return $attr;
        };
        $key = function (Options $options, $key) {
            return $key ?: $options['name'];
        };

        $resolver
            ->setRequired('name')
            ->setRequired('source')

            ->setAllowedTypes('hint', 'boolean')
            ->setAllowedTypes('highlight', 'boolean')
            ->setAllowedTypes('min_length', 'integer')
            ->setAllowedTypes('class_names', 'array')
            ->setAllowedTypes('source', 'array')
            ->setAllowedTypes('limit', ['array', 'integer'])
            ->setAllowedTypes('config', 'array')

            ->setNormalizer('config', $config)
            ->setNormalizer('attr', $attr)
            ->setNormalizer('key', $key)
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['config'] = $options['config'];

        // Data set.
        $view->vars['name']     = $options['name'];
        $view->vars['source']   = $options['source'];
        $view->vars['limit']    = $options['limit'];
        $view->vars['matcher']  = $options['matcher'];
        $view->vars['property'] = $options['property'];
        $view->vars['key']      = $options['key'];

        $view->vars['typeahead_value'] = $view->vars['value'];

        if ($view->vars['value'] && $options['key']) {
            $property = PropertyAccess::createPropertyAccessor();

            $key = '['.$options['key'].']';
            $label = '['.$options['property'].']';

            foreach ($view->vars['source'] as $item) {
                if ($view->vars['value'] === $property->getValue($item, $key)) {
                    $view->vars['typeahead_value'] = $property->getValue($item, $label);
                    break;
                }
            }
        }
    }
}

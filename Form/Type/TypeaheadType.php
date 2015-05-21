<?php

namespace Devmachine\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeaheadType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_typeahead';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

            // Configs.
            'hint'        => true,
            'highlight'   => true,
            'min_length'  => 3,
            'class_names' => [],
            'config'      => [],

            // Data set.
            'source'    => [],
            'limit'     => 5,
            'value_key' => null,
            'label_key' => null,
            'matcher'   => 'contains',

            'route_name'   => null,
            'route_params' => [],

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

        $resolver
            ->setRequired('name')
            ->setRequired('source')

            ->setAllowedTypes('hint', 'boolean')
            ->setAllowedTypes('highlight', 'boolean')
            ->setAllowedTypes('min_length', 'integer')
            ->setAllowedTypes('class_names', 'array')
            ->setAllowedTypes('config', 'array')

            ->setAllowedTypes('source', 'array')
            ->setAllowedTypes('limit', 'integer')
            ->setAllowedTypes('matcher', 'string')

            ->setAllowedValues('matcher', ['contains', 'starts_with', 'ends_with'])

            ->setNormalizer('config', $config)
            ->setNormalizer('attr', $attr)
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['config']       = $options['config'];
        $view->vars['name']         = $options['name'];
        $view->vars['source']       = $options['source'];
        $view->vars['limit']        = $options['limit'];
        $view->vars['value_key']    = $options['value_key'];
        $view->vars['label_key']    = $options['label_key'];
        $view->vars['matcher']      = self::getMatcherFunction($options['matcher']);
        $view->vars['route_name']   = $options['route_name'];
        $view->vars['route_params'] = $options['route_params'];

        $view->vars['typeahead_value'] = $view->vars['value'];

        if ($view->vars['value'] && $options['value_key']) {
            foreach ($view->vars['source'] as $item) {
                if ($view->vars['value'] === $item[$options['value_key']]) {
                    $view->vars['typeahead_value'] = $item[$options['label_key']];
                    break;
                }
            }
        }
    }

    /**
     * starts_with -> startsWithMatcher
     *
     * @param string $string
     *
     * @return string
     */
    private static function getMatcherFunction($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(strtr($string, '_-', ' '))));
    }
}

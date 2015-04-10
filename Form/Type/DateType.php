<?php

namespace Devmachine\FormBundle\Form\Type;

use Devmachine\FormBundle\Form\JavascriptFormatConverter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_date';
    }

    public function getParent()
    {
        return 'date';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $configNormalizer = function (Options $options, $config) {
            $config['language'] = $options['language'];

            // Multi dates not supported yet.
            if (isset($config['multidate'])) {
                unset($config['multidate']);
            }

            // Date range not supported yet.
            if (isset($config['inputs'])) {
                unset($config['inputs']);
            }

            $config['format'] = call_user_func($options['formatter'], $options['format']);

            return $config;
        };

        $language = function (Options $options) {
            return \Locale::getPrimaryLanguage($options['locale']);
        };
        $formatter = function (Options $options) {
            return new JavascriptFormatConverter($options['locale']);
        };

        $resolver->setDefaults([
            'widget'      => 'single_text',
            'html5'       => false,
            'input_addon' => false,
            'inline'      => false,
            'locale'      => \Locale::getDefault(),
            'language'    => $language,
            'formatter'   => $formatter,
            'config'      => [],
        ]);

        $resolver
            // Do not inherit certain rules.
            ->setAllowedValues('widget', ['single_text'])
            ->setAllowedValues('html5', [false])
            ->remove(['years', 'month', 'days'])

            ->setAllowedValues('input_addon', [true, false])
            ->setAllowedValues('inline', [true, false])
            ->setAllowedTypes('config', 'array')
            ->setAllowedTypes('formatter', 'callable')
            ->setNormalizer('config', $configNormalizer)
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['input_addon'] = $options['input_addon'];
        $view->vars['inline'] = $options['inline'];
        $view->vars['config'] = $options['config'];
    }
}

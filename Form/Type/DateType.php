<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Devmachine\Bundle\FormBundle\Converter\BootstrapFormatConverter;
use Devmachine\Bundle\FormBundle\Form\DateNormalizer;
use Devmachine\Bundle\FormBundle\FormatConfiguration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateType extends AbstractType
{
    private $configuration;
    private $dateNormalizer;

    public function __construct(FormatConfiguration $configuration, DateNormalizer $dateNormalizer)
    {
        $this->configuration = $configuration;
        $this->dateNormalizer = $dateNormalizer;
    }

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
                throw new \RuntimeException("Config option 'multiday' is not supported yet.");
            }

            // Date range not supported yet.
            if (isset($config['inputs'])) {
                throw new \RuntimeException("Config option 'inputs' is not supported yet.");
            }

            if (isset($config['datesDisabled'])) {
                $config['datesDisabled'] = (array) $config['datesDisabled'];
            }

            $config['format'] = call_user_func($options['formatter'], $options['format']);

            return $config;
        };

        $language = function (Options $options) {
            return \Locale::getPrimaryLanguage($options['locale']);
        };
        $formatter = function (Options $options) {
            return new BootstrapFormatConverter($options['locale']);
        };

        $resolver->setDefaults([
            'format'      => $this->configuration->getDateFormat(),
            'widget'      => 'single_text',
            'html5'       => false,
            'input_addon' => false,
            'inline'      => false,
            'locale'      => \Locale::getDefault(),
            'language'    => $language,
            'formatter'   => $formatter,
            'config'      => [], // http://bootstrap-datepicker.readthedocs.org/en/latest/options.html
        ]);

        $resolver
            // Do not inherit certain rules.
            ->setAllowedValues('widget', ['single_text'])
            ->setAllowedValues('html5', [false])
            ->setAllowedTypes('format', 'string')
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

        $config = &$view->vars['config'];

        if (!empty($config['startDate'])) {
            $config['startDate'] = $this->dateNormalizer->normalizeDate($config['startDate'], $form);
        }
        if (!empty($config['endDate'])) {
            $config['endDate'] = $this->dateNormalizer->normalizeDate($config['endDate'], $form);
        }
        if (!empty($config['datesDisabled'])) {
            foreach ($config['datesDisabled'] as $index => $date) {
                $config['datesDisabled'][$index] = $this->dateNormalizer->normalizeDate($date, $form);
            }
        }
    }

    /**
     * BC for Symfony <2.7.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }
}

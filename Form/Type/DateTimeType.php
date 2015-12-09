<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Devmachine\Bundle\FormBundle\Converter\MomentJsFormatConverter;
use Devmachine\Bundle\FormBundle\FormatConfiguration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as SymfonyDateTimeType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    private $configuration;

    public function __construct(FormatConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getBlockPrefix()
    {
        return 'devmachine_datetime';
    }

    public function getParent()
    {
        return SymfonyDateTimeType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $configNormalizer = function (Options $options, $config) {
            $config['locale'] = $options['locale'];
            $config['format'] = call_user_func($options['formatter'], $options['format']);

            // Do not support for now.
            if (!empty($config['extraFormats'])) {
                unset($config['extraFormats']);
            }

            if (!empty($config['dayViewHeaderFormat'])) {
                $config['dayViewHeaderFormat'] = call_user_func($options['formatter'], $config['dayViewHeaderFormat']);
            }

            // Rename config keys.
            if (!empty($config['startDate'])) {
                $config['minDate'] = $config['startDate'];
                unset($config['startDate']);
            }
            if (!empty($config['endDate'])) {
                $config['maxDate'] = $config['endDate'];
                unset($config['endDate']);
            }

            if (!empty($options['inline'])) {
                $config['inline'] = $options['inline'];
                $config['sideBySide'] = true;
            }

            // Normalize dates.
            if (!empty($config['minDate'])) {
                $config['minDate'] = $this->normalizeDate($config['minDate']);
            }
            if (!empty($config['maxDate'])) {
                $config['maxDate'] = $this->normalizeDate($config['maxDate']);
            }
            if (!empty($config['enabledDates'])) {
                $config['enabledDates'] = $this->normalizeDates($config['enabledDates']);
            }
            if (!empty($config['disabledDates'])) {
                $config['disabledDates'] = $this->normalizeDates($config['disabledDates']);
            }

            return $config;
        };

        $formatter = function (Options $options) {
            return new MomentJsFormatConverter($options['locale']);
        };

        $resolver->setDefaults([
            'format'      => $this->configuration->getDatetimeFormat(),
            'widget'      => 'single_text',
            'html5'       => false,
            'input_addon' => false,
            'inline'      => false,
            'locale'      => \Locale::getDefault(),
            'formatter'   => $formatter,
            'config'      => [],
        ]);

        $resolver
            // Do not inherit certain rules.
            ->setAllowedValues('widget', ['single_text'])
            ->setAllowedValues('html5', [false])
            ->setAllowedTypes('format', 'string')
            ->remove(['years', 'month', 'days', 'hours', 'minutes', 'seconds'])

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

    private function normalizeDate($date)
    {
        return $date instanceof \DateTime ? $date->format('Y-m-d') : $date;
    }

    private function normalizeDates($dates)
    {
        return array_map([$this, 'normalizeDate'], (array) $dates);
    }
}

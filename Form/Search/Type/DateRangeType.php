<?php

namespace Devmachine\FormBundle\Form\Search\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateRangeType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_search_range_date';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => 'Devmachine\FormBundle\Form\Search\Model\DateRange',
            'value_type'    => 'devmachine_date',
            'start_options' => [],
            'end_options'   => [],
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $startOptions = array_merge([
            'required' => false,
            'label' => 'range.label.start_date',
        ], $options['start_options']);

        $endOptions = array_merge([
            'required' => false,
            'label' => 'range.label.end_date',
        ], $options['end_options']);

        $builder
            ->add('startDate', $options['value_type'], $startOptions)
            ->add('endDate', $options['value_type'], $endOptions)
        ;
    }

    /**
     * BC.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $resolver */
        $this->configureOptions($resolver);
    }
}

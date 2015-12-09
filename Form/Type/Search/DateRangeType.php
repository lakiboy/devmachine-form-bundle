<?php

namespace Devmachine\Bundle\FormBundle\Form\Type\Search;

use Devmachine\Bundle\FormBundle\Form\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateRangeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'value_type'    => DateType::class,
            'start_options' => [],
            'end_options'   => [],
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $startOptions = array_merge([
            'required' => false,
            'label'    => 'range.label.start_date',
        ], $options['start_options']);

        $endOptions = array_merge([
            'required' => false,
            'label'    => 'range.label.end_date',
        ], $options['end_options']);

        $builder
            ->add('startDate', $options['value_type'], $startOptions)
            ->add('endDate', $options['value_type'], $endOptions)
        ;
    }
}

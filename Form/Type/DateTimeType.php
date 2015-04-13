<?php

namespace Devmachine\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_datetime';
    }

    public function getParent()
    {
        return 'datetime';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    }
}

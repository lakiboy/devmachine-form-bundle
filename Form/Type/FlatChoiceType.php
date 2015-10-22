<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Devmachine\Bundle\FormBundle\Form\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlatChoiceType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_flat_choice';
    }

    public function getParent()
    {
        return 'text';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new ArrayToStringTransformer($options['separator']));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'separator' => ', ',
        ]);
    }
}

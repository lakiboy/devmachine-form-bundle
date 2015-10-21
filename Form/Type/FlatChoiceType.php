<?php

namespace Devmachine\FormBundle\Form\Type;

use Devmachine\FormBundle\Form\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            'multiple' => true,
            'separator' => ', ',
        ]);
    }

    /**
     * BC.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /* @var \Symfony\Component\OptionsResolver\OptionsResolver $resolver */
        $this->configureOptions($resolver);
    }
}

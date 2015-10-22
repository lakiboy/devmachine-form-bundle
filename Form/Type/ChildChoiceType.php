<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChildChoiceType extends AbstractType
{
    public function getName()
    {
        return 'devmachine_child_choice';
    }

    public function getParent()
    {
        return 'choice';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['group_by', 'parent']);
        $resolver->setDefaults(['select2' => false]);
        $resolver->setAllowedTypes('select2', 'boolean');
        $resolver->setAllowedTypes('group_by', 'string');
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['parent'] = $options['parent'];
        $view->vars['select2'] = $options['select2'];
    }
}

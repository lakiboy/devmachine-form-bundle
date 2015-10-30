<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
        $resolver->setDefaults(['select2' => false, 'group_by' => null]); // Set "group_by" to null for BC.
        $resolver->setAllowedTypes('select2', 'boolean');
        $resolver->addAllowedTypes('group_by', ['string', 'null']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['parent'] = $options['parent'];
        $view->vars['select2'] = $options['select2'];
    }

    /**
     * BC for Symfony <2.7.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }
}

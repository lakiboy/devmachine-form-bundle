<?php

namespace Devmachine\Bundle\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChildChoiceType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'devmachine_child_choice';
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $attr = function (Options $options) {
            return $options['select2'] ? ['style' => 'width: 100%;'] : [];
        };

        $resolver
            ->setRequired(['group_by', 'parent'])
            ->setDefaults(['select2' => false, 'attr' => $attr])
            ->setAllowedTypes('select2', 'boolean')
            ->addAllowedTypes('group_by', ['string'])
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['parent']  = $options['parent'];
        $view->vars['select2'] = $options['select2'];
    }
}

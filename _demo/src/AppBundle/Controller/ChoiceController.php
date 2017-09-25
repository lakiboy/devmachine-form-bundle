<?php

namespace AppBundle\Controller;

use Devmachine\Bundle\FormBundle\Form\Type\ChildChoiceType;
use Devmachine\Bundle\FormBundle\Form\Type\FlatChoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChoiceController extends Controller
{
    use ServicesTrait;

    /**
     * @Route("/", name="choice")
     * @Template("AppBundle::choice.html.twig")
     */
    public function indexAction()
    {
        return [
            'flat'  => $this->flatForm()->createView(),
            'child' => $this->childForm()->createView(),
            'title' => 'Choices',
            'nav'   => 'choice',
        ];
    }

    private function flatForm()
    {
        $langs = ['PHP', 'Ruby', 'Python', 'Go', 'Java'];

        $form = $this->createNamedBuilder('flat')
            ->add('langs', FlatChoiceType::class, [
                'label'     => 'Programming languages',
                'separator' => ', ', // default
            ])
            ->getForm()
            ->setData(['langs' => $langs])
        ;

        return $form;
    }

    private function childForm()
    {
        $countries = ['Germany', 'Japan'];

        $manufacturers = [
            'Germany'  => ['BMW', 'Audi', 'Mercedes'],
            'Japan'    => ['Honda', 'Toyota', 'Nissan'],
        ];

        $models = [
            'BMW'      => ['X3', 'X5', 'X6'],   'Audi'   => ['A1', 'A6', 'A6'],
            'Mercedes' => ['Vito', 'Sprinter'], 'Honda'  => ['Accord', 'Civic'],
            'Toyota'   => ['Avensis', 'Camry'], 'Nissan' => ['Versa', 'X-trail'],
        ];

        $combine = function (array $items) { return array_combine($items, $items); };

        $form = $this->createNamedBuilder('child')
            ->add('country', ChoiceType::class, [
                'choices'     => $combine($countries),
                'required'    => false,
                'placeholder' => 'Select country',
            ])
            ->add('manufacturer', ChildChoiceType::class, [
                'parent'      => 'country',
                'required'    => false,
                'placeholder' => 'Select manufacturer',
                'choices'     => array_map($combine, $manufacturers),
            ])
            ->add('model', ChildChoiceType::class, [
                'parent'      => 'manufacturer',
                'required'    => false,
                'placeholder' => 'Select model',
                'choices'     => array_map($combine, $models),
                'select2'     => true, // Style with select2
            ])
            ->getForm()
        ;

        return $form;
    }
}

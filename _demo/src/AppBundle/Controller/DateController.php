<?php

namespace AppBundle\Controller;

use Devmachine\Bundle\FormBundle\Form\Type\DateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DateController extends Controller
{
    use ServicesTrait;

    /**
     * @Route("/", name="date")
     * @Template("AppBundle::date.html.twig")
     */
    public function indexAction()
    {
        return [
            'default' => $this->defaultForm()->createView(),
            'inline'  => $this->inlineForm()->createView(),
            'addon'   => $this->addonForm()->createView(),
            'title'   => 'Bootstrap date',
            'nav'     => 'date',
        ];
    }

    private function defaultForm()
    {
        return $this->createNamedBuilder('default')
            ->add('date', DateType::class, [
                'config' => [
                    'clearBtn'       => true,
                    'orientation'    => 'top',
                    'todayHighlight' => true,
                ],
                'format' => 'dd/MM/y',
            ])
            ->getForm()
        ;
    }

    private function addonForm()
    {
        return $this->createNamedBuilder('addon')
            ->add('date', DateType::class, [
                'input_addon' => true,
                'locale'      => 'ru',
            ])
            ->getForm()
        ;
    }

    private function inlineForm()
    {
        return $this->createNamedBuilder('inline')
            ->add('date', DateType::class, [
                'inline' => true,
            ])
            ->getForm()
        ;
    }
}

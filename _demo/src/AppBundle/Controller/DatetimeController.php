<?php

namespace AppBundle\Controller;

use Devmachine\Bundle\FormBundle\Form\Type\DateTimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DatetimeController extends Controller
{
    use ServicesTrait;

    /**
     * @Route("/", name="datetime")
     * @Template("AppBundle::datetime.html.twig")
     */
    public function indexAction()
    {
        return [
            'default' => $this->defaultForm()->createView(),
            'inline'  => $this->inlineForm()->createView(),
            'addon'   => $this->addonForm()->createView(),
            'title'   => 'Bootstrap datetime',
            'nav'     => 'datetime',
        ];
    }

    private function defaultForm()
    {
        return $this->createNamedBuilder('default')
            ->add('datetime', DateTimeType::class, [
                'config' => [
                    'calendarWeeks'   => true,
                    'showTodayButton' => true,
                    'showClear'       => true,
                    'showClose'       => true,
                ],
                'format' => 'dd/MM/y HH:mm',
            ])
            ->getForm()
        ;
    }

    private function addonForm()
    {
        return $this->createNamedBuilder('addon')
            ->add('datetime', DateTimeType::class, [
                'input_addon' => true,
                'locale'      => 'ru',
            ])
            ->getForm()
        ;
    }

    private function inlineForm()
    {
        return $this->createNamedBuilder('inline')
            ->add('datetime', DateTimeType::class, [
                'inline' => true,
            ])
            ->getForm()
        ;
    }
}

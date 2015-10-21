<?php

namespace Devmachine\FormBundle\Tests\Twig;

use Devmachine\FormBundle\Twig\GenemuFormExtension;
use Symfony\Component\Form\FormView;

class GenemuFormExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_registers_functions()
    {
        $twig = new \Twig_Environment();
        $twig->addExtension(new GenemuFormExtension($this->getMock('Symfony\Bridge\Twig\Form\TwigRendererInterface')));

        $f1 = $twig->getFunction('form_javascript');
        $f2 = $twig->getFunction('form_stylesheet');

        $this->assertInstanceOf('Twig_SimpleFunction', $f1);
        $this->assertInstanceOf('Twig_SimpleFunction', $f2);
    }

    /**
     * @test
     */
    public function it_proxies_to_form_renderer()
    {
        $view = new FormView();

        $renderer = $this->getMock('Symfony\Bridge\Twig\Form\TwigRendererInterface');
        $renderer
            ->expects($this->exactly(3))
            ->method('searchAndRenderBlock')
            ->withConsecutive(
                [$this->equalTo($view), 'javascript'],
                [$this->equalTo($view), 'javascript_prototype'],
                [$this->equalTo($view), 'stylesheet']
            )
        ;

        $twig = new \Twig_Environment();
        $twig->addExtension(new GenemuFormExtension($renderer));

        call_user_func($twig->getFunction('form_javascript')->getCallable(), $view);
        call_user_func($twig->getFunction('form_javascript')->getCallable(), $view, true);
        call_user_func($twig->getFunction('form_stylesheet')->getCallable(), $view);
    }
}
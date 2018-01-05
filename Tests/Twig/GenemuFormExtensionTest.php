<?php

namespace Devmachine\Bundle\FormBundle\Tests\Twig;

use Devmachine\Bundle\FormBundle\Twig\GenemuFormExtension;
use Symfony\Component\Form\FormView;

class GenemuFormExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_registers_functions()
    {
        $twig = new \Twig_Environment(new \Twig_Loader_Array());
        $twig->addExtension(new GenemuFormExtension($this->getMock('Symfony\Component\Form\FormRendererInterface')));

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

        $renderer = $this->getMock('Symfony\Component\Form\FormRendererInterface');
        $renderer
            ->expects($this->exactly(3))
            ->method('searchAndRenderBlock')
            ->withConsecutive(
                [$this->equalTo($view), 'javascript'],
                [$this->equalTo($view), 'javascript_prototype'],
                [$this->equalTo($view), 'stylesheet']
            )
        ;

        $twig = new \Twig_Environment(new \Twig_Loader_Array());
        $twig->addExtension(new GenemuFormExtension($renderer));

        call_user_func($twig->getFunction('form_javascript')->getCallable(), $view);
        call_user_func($twig->getFunction('form_javascript')->getCallable(), $view, true);
        call_user_func($twig->getFunction('form_stylesheet')->getCallable(), $view);
    }

    protected function getMock($originalClassName)
    {
        if (method_exists($this, 'createMock')) {
            return $this->createMock($originalClassName);
        }

        return parent::getMock($originalClassName);
    }
}

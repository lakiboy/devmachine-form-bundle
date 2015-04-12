<?php

namespace Devmachine\FormBundle\Twig;

use Symfony\Component\Form\FormView;
use Symfony\Bridge\Twig\Form\TwigRendererInterface;

/**
 * Copied from https://github.com/genemu/GenemuFormBundle/blob/master/Twig/Extension/FormExtension.php
 */
class GenemuFormExtension extends \Twig_Extension
{
    public $renderer;

    public function __construct(TwigRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getFunctions()
    {
        return array(
            'form_javascript' => new \Twig_Function_Method($this, 'renderJavascript', ['is_safe' => ['html']]),
            'form_stylesheet' => new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', ['is_safe' => ['html']]),
        );
    }

    public function renderJavascript(FormView $view, $prototype = false)
    {
        $block = $prototype ? 'javascript_prototype' : 'javascript';

        return $this->renderer->searchAndRenderBlock($view, $block);
    }

    public function getName()
    {
        return 'genemu.twig.extension.form';
    }
}

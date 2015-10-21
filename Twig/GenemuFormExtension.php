<?php

namespace Devmachine\FormBundle\Twig;

use Symfony\Component\Form\FormView;
use Symfony\Bridge\Twig\Form\TwigRendererInterface;

/**
 * Copied from https://github.com/genemu/GenemuFormBundle/blob/master/Twig/Extension/FormExtension.php.
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
        return [
            new \Twig_SimpleFunction('form_javascript', [$this, 'renderJavascript'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('form_stylesheet', [$this, 'renderStylesheet'], ['is_safe' => ['html']]),
        ];
    }

    public function renderJavascript(FormView $view, $prototype = false)
    {
        $block = $prototype ? 'javascript_prototype' : 'javascript';

        return $this->renderer->searchAndRenderBlock($view, $block);
    }

    public function renderStylesheet(FormView $view)
    {
        return $this->renderer->searchAndRenderBlock($view, 'stylesheet');
    }

    public function getName()
    {
        return 'genemu.twig.extension.form';
    }
}

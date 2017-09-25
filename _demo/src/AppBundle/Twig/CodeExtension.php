<?php

namespace AppBundle\Twig;

use AppBundle\CodeReader;

class CodeExtension extends \Twig_Extension
{
    private $reader;

    public function __construct(CodeReader $reader)
    {
        $this->reader = $reader;
    }

    public function getName()
    {
        return 'app_code';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('app_method_source', [$this, 'getMethodSource']),
            new \Twig_SimpleFunction('app_class_source', [$this, 'getClassSource']),
        ];
    }

    public function getMethodSource($spec, $bound = CodeReader::BOUND_FORM_BUILDER)
    {
        return $this->reader->readMethod($spec, $bound);
    }

    public function getClassSource($class)
    {
        return $this->reader->readClass($class);
    }
}

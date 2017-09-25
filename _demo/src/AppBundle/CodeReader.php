<?php

namespace AppBundle;

class CodeReader
{
    const BOUND_FORM_BUILDER    = 'form_builder';
    const BOUND_FORM_DEFINITION = 'form_definition';
    const BOUND_FULL_METHOD     = 'full_method';

    private $bounds = [
        self::BOUND_FORM_BUILDER    => [12, 2, -5],
        self::BOUND_FORM_DEFINITION => [8, 1, -4],
        self::BOUND_FULL_METHOD     => [4, -4, 4],
    ];

    /**
     * @var \ReflectionClass[]
     */
    private $cache = [];

    /**
     * @param string $spec  AppBundle:Controller:action
     * @param string $bound
     *
     * @return string
     */
    public function readMethod($spec, $bound = self::BOUND_FORM_BUILDER)
    {
        list($bundle, $controller, $method) = explode(':', $spec);

        $controllerClass = sprintf('%s\Controller\%sController', $bundle, $controller);

        return $this->readSource($controllerClass, $method, $this->bounds[$bound]);
    }

    /**
     * @param string $className
     *
     * @return string
     */
    public function readClass($className)
    {
        return trim(file_get_contents($this->getReflectionClass($className)->getFileName()));
    }

    /**
     * @param string $class
     * @param string $method
     * @param array  $bounds
     *
     * @return string
     */
    private function readSource($class, $method, array $bounds)
    {
        $rc = $this->getReflectionClass($class);
        $rm = $rc->getMethod($method);

        // Read method source.
        $source = file($rc->getFileName());
        $source = array_slice($source, $rm->getStartLine() + $bounds[1], $rm->getEndLine() - $rm->getStartLine() + $bounds[2]);

        // Remove indent.
        $source = array_map(function ($line) use ($bounds) {
            return preg_replace("/^ {{$bounds[0]}}/", '', $line);
        }, $source);

        return trim(implode('', $source));
    }

    /**
     * @param string $class
     *
     * @return \ReflectionClass
     */
    private function getReflectionClass($class)
    {
        if (!isset($this->cache[$class])) {
            $this->cache[$class] = new \ReflectionClass($class);
        }

        return $this->cache[$class];
    }
}

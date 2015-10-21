<?php

namespace Devmachine\Bundle\FormBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArrayToStringTransformer implements DataTransformerInterface
{
    private $separator;

    public function __construct($separator = ', ')
    {
        $this->separator = $separator;
    }

    public function transform($value)
    {
        if ($value === null) {
            return '';
        }

        if (!is_array($value)) {
            throw new TransformationFailedException(sprintf('Expected array, got %s', is_scalar($value) ? gettype($value) : get_class($value)));
        }

        return implode($this->separator, $value);
    }

    public function reverseTransform($value)
    {
        if ($value === '' || $value === null) {
            return;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException(sprintf('Expected string, got %s', is_scalar($value) ? gettype($value) : get_class($value)));
        }

        return array_map('trim', explode($this->separator, $value));
    }
}

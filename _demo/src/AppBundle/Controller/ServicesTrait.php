<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;

trait ServicesTrait
{
    /**
     * @param string $name
     * @param mixed  $data
     * @param array  $options
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function createNamedBuilder($name, $data = null, array $options = [])
    {
        /** @var \Symfony\Component\Form\FormFactoryInterface $factory */
        $factory = $this->container->get('form.factory');

        $defaults = ['action' => '#'];

        return $factory->createNamedBuilder($name, FormType::class, $data, array_merge($defaults, $options));
    }
}

<?php

namespace Devmachine\FormBundle\Form;

use Symfony\Component\Form\FormInterface;

class DateNormalizer
{
    /**
     * @param string|\DateTime $date
     * @param FormInterface    $form
     *
     * @return \DateTime|string
     */
    public function normalizeDate($date, FormInterface $form)
    {
        if (!$date instanceof \DateTime) {
            return $date;
        }

        $result = $date;
        foreach ($form->getConfig()->getViewTransformers() as $transformer) {
            $result = $transformer->transform($result);
        }

        return $result;
    }
}

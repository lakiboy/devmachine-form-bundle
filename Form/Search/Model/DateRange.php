<?php

namespace Devmachine\FormBundle\Form\Search\Model;

class DateRange
{
    private $start;
    private $end;

    public function setStart(\DateTimeInterface $start = null)
    {
        $this->start = $start;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getStart()
    {
        return $this->start;
    }

    public function setEnd(\DateTimeInterface $end = null)
    {
        $this->end = $end;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEnd()
    {
        return $this->end;
    }
}

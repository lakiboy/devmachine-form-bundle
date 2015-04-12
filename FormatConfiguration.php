<?php

namespace Devmachine\FormBundle;

class FormatConfiguration
{
    private $dateFormat;

    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }
}

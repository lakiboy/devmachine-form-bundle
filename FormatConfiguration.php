<?php

namespace Devmachine\FormBundle;

class FormatConfiguration
{
    private $dateFormat;
    private $dateTimeFormat;

    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    public function setDateTimeFormat($dateTimeFormat)
    {
        $this->dateTimeFormat = $dateTimeFormat;
    }

    public function getDateTimeFormat()
    {
        return $this->dateTimeFormat;
    }
}

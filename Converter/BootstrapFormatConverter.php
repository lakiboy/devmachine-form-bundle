<?php

namespace Devmachine\FormBundle\Converter;

class BootstrapFormatConverter extends JavascriptFormatConverter
{
    // http://bootstrap-datepicker.readthedocs.org/en/latest/options.html#format
    protected $symbolsMap = [
        'dd'    => 'dd',   // 05
        'd'     => 'd',    // 5

        'MMMMM' => 'M',    // Not supported by Bootstrap calendar
        'MMMM'  => 'MM',   // January
        'MMM'   => 'M',    // Jan
        'MM'    => 'mm',   // 07
        'M'     => 'm',    // 7

        'yyyy'  => 'yyyy', // 2012
        'yy'    => 'yy',   // 12
        'y'     => 'yyyy',
    ];
}

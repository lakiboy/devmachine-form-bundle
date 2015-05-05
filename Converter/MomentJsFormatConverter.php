<?php

namespace Devmachine\FormBundle\Converter;

class MomentJsFormatConverter extends JavascriptFormatConverter
{
    // http://momentjs.com/docs/#/displaying/format/
    protected $symbolsMap = [
        'dd'     => 'DD',   // 05
        'd'      => 'D',    // 5

        'MMMMM'  => 'M',    // Not supported by Moment js
        'MMMM'   => 'MMMM', // January
        'MMM'    => 'MMM',  // Jan
        'MM'     => 'MM',   // 07
        'M'      => 'M',    // 7

        'yyyy'   => 'YYYY', // 2012
        'yy'     => 'YY',   // 12
        'y'      => 'YYYY',

        // am/pm
        'a'      => 'a',

        // hour in am/pm (1~12)
        'hh'     => 'hh',
        'h'      => 'h',

        // hour in day (0~23)
        'HH'     => 'HH',
        'H'      => 'H',

        // minutes
        'mm'     => 'mm',   // 04
        'm'      => 'm',    // 4

        // seconds
        'ss'     => 'ss',   // 05
        's'      => 's',    // 5

        // Quarter
        'Q'      => 'Q',    // 1

        // Day of year
        'D'      => 'DDD',  // 189
    ];
}

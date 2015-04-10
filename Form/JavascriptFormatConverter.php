<?php

namespace Devmachine\FormBundle\Form;

class JavascriptFormatConverter
{
    // http://userguide.icu-project.org/formatparse/datetime
    private $symbolsMap = [
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

    private $locale;
    private $timezone;
    private $calendar;

    /**
     * @param string $locale
     * @param string $timezone
     * @param int    $calendar
     */
    public function __construct($locale, $timezone = 'UTC', $calendar = \IntlDateFormatter::GREGORIAN)
    {
        $this->locale = $locale;
        $this->timezone = $timezone;
        $this->calendar = $calendar;
    }

    /**
     * @param int|string $dateFormat
     * @param int        $timeFormat
     *
     * @return string
     */
    public function __invoke($dateFormat, $timeFormat = \IntlDateFormatter::NONE)
    {
        return $this->format($dateFormat, $timeFormat);
    }

    /**
     * @param int|string $dateFormat
     * @param int        $timeFormat
     *
     * @return string
     */
    public function format($dateFormat, $timeFormat)
    {
        $formatter = new \IntlDateFormatter(
            $this->locale,
            $dateFormat,
            $timeFormat,
            $this->timezone,
            $this->calendar,
            is_string($dateFormat) ? $dateFormat : null
        );

        return $this->toJavascriptFormat($formatter->getPattern());
    }

    /**
     * @param string $pattern
     *
     * @return string
     */
    public function toJavascriptFormat($pattern)
    {
        // Remove escaping from literals. Taken from here - https://github.com/yiisoft/yii2/blob/master/framework/helpers/BaseFormatConverter.php
        $escaped = [];
        if (preg_match_all('/(?<!\')\'.*?[^\']\'(?!\')/', $pattern, $matches)) {
            foreach ($matches[0] as $match) {
                $escaped[$match] = trim($match, '\'');
            }
        }

        return strtr($pattern, array_merge($escaped, $this->symbolsMap));
    }
}

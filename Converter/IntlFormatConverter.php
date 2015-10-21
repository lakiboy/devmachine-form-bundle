<?php

namespace Devmachine\Bundle\FormBundle\Converter;

abstract class IntlFormatConverter
{
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
        return $this->convert($dateFormat, $timeFormat);
    }

    /**
     * @param int|string $dateFormat
     * @param int        $timeFormat
     *
     * @return string
     */
    public function convert($dateFormat, $timeFormat = \IntlDateFormatter::NONE)
    {
        $formatter = new \IntlDateFormatter(
            $this->locale,
            is_string($dateFormat) ? \IntlDateFormatter::MEDIUM : $dateFormat,
            $timeFormat,
            $this->timezone,
            $this->calendar,
            is_string($dateFormat) ? $dateFormat : null
        );

        return $this->format($formatter->getPattern());
    }

    /**
     * @param string $pattern
     *
     * @return string
     */
    abstract protected function format($pattern);
}

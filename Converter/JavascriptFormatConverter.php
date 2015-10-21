<?php

namespace Devmachine\Bundle\FormBundle\Converter;

class JavascriptFormatConverter extends IntlFormatConverter
{
    // http://userguide.icu-project.org/formatparse/datetime
    protected $symbolsMap = [];

    public function setSymbolsMap(array $symbolsMap)
    {
        $this->symbolsMap = $symbolsMap;
    }

    /**
     * @param string $pattern
     *
     * @return string
     */
    protected function format($pattern)
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

<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class NumberFormatter implements Formatter
{
    /**
     * @param float|mixed $value
     * @return string
     */
    public function format($value)
    {
        return $number = number_format($value, 0, ',', '.');
    }
}
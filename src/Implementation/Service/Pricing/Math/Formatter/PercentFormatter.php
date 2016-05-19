<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class PercentFormatter implements Formatter
{
    /**
     * @param float|mixed $value
     * @return string
     */
    public function format($value)
    {
        $value = $value * 100;
        return number_format($value, 2, ',', '.').'%';
    }
}
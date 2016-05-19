<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class FloorFormatter implements Formatter
{
    /**
     * @param float|mixed $value
     * @return string
     */
    public function format($value)
    {
        return (string)intval(floatval($value));
    }
}
<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class CeilFormatter implements Formatter
{
    /**
     * @param float|mixed $value
     * @return string
     */
    public function format($value)
    {
        return (string)(int)ceil($value);
    }
}
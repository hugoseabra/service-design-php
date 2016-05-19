<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class DecimalFormatter implements Formatter
{
    protected $digits;

    /**
     * DecimalFormatter constructor.
     * @param integer $digits
     */
    public function __construct($digits = 2)
    {
        $this->digits = $digits;
    }

    /**
     * @param float|mixed $value
     * @return string
     * @throws \Exception
     */
    public function format($value)
    {
        $value = $this->forceValue($value);
        return (!$this->digits)
            ? (int)$value
            : number_format($value, $this->digits, ',', '.');
    }

    /**
     * @param mixed $value
     * @return float
     */
    protected function forceValue($value)
    {
        if (!is_float($value) && !is_double($value)) {
            $value = (float)$value;
        }
        return $value;
    }
}
<?php

namespace Implementation\Service\Pricing\Math\Formatter;

use Service\Pricing\Math\Formatter;

class MoneyFormatter implements Formatter
{
    protected $moneySignal;

    /**
     * MoneyFormatter constructor.
     * @param string $moneySignal
     */
    public function __construct($moneySignal = 'R$')
    {
        $this->moneySignal = $moneySignal;
    }

    /**
     * @param float|mixed $value
     * @return string
     * @throws \Exception
     */
    public function format($value)
    {
        $this->checkValue($value);

        return $this->moneySignal.' '. number_format($value, 2, ',', '.');
    }

    /**
     * @param mixed $value
     * @throws \Exception
     */
    protected function checkValue($value)
    {
        if (!is_float($value) && !is_double($value)) {
            throw new \Exception('Value must be a float type to be money format.');
        }
    }
}
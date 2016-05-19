<?php

namespace Implementation\Service\Pricing\Math\Operation;

class Adition extends AbstractMathOperation
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'adition';
    }

    protected function calculate($var1, $var2)
    {
        return $var1 + $var2;
    }
}
<?php

namespace Implementation\Service\Pricing\Math\Operation;

class Multiplication extends AbstractMathOperation
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'multiplication';
    }

    protected function calculate($var1, $var2)
    {
        return $var1 * $var2;
    }
}
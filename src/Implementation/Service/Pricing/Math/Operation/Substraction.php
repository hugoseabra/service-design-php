<?php

namespace Implementation\Service\Pricing\Math\Operation;

class Substraction extends AbstractMathOperation
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'substraction';
    }

    protected function calculate($var1, $var2)
    {
        return $var1 - $var2;
    }
}
<?php

namespace Implementation\Service\Pricing\Math\Operation;

class Division extends AbstractMathOperation
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'division';
    }

    protected function calculate($var1, $var2)
    {
        return ($var2) ? $var1 / $var2 : 0;
    }
}
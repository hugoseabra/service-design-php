<?php

namespace Implementation\Service\Pricing\Math\Operation;

class Square extends AbstractNumberOperation
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'square';
    }

    protected function operate($var1)
    {
        return sqrt($var1);
    }
}
<?php

namespace Implementation\Service\Pricing\Math\StrictType;

class MoneyType extends FloatType
{
    /**
     * @Override
     * @return string
     */
    public function __toString()
    {
        return 'money';
    }
}
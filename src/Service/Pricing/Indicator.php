<?php

namespace Service\Pricing;

use Service\Pricing\Math\MathResult;
use Service\Processable;

/**
 * Defines an object which behavior is to support mathematical operations by manipulating parameters and obtaining its
 * mathematical results.
 *
 * Interface Indicator
 * @package Service\Pricing
 */
interface Indicator extends Parameter, Processable, Calculable
{
    /**
     * @return MathResult
     */
    public function getResult();
}
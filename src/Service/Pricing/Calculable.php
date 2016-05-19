<?php

namespace Service\Pricing;

use Service\Pricing\Math\Operation\NumberOperation;
use Service\Pricing\Math\Operation\MathOperation;

/**
 * Defines a calculable object which supports mathematical operations and manipulation of its operation definition.
 *
 * Interface Calculable
 * @package Service\Pricing
 */
interface Calculable
{
    /**
     * @return NumberOperation|MathOperation
     */
    public function getMathOperation();

    /**
     * @param NumberOperation|MathOperation $mathOperation
     */
    public function updateMathOperation(NumberOperation $mathOperation);
}
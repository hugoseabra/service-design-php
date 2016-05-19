<?php

namespace Service\Pricing\Math\Operation;

use Service\Pricing\Parameter;

/**
 * Defines an object which supports math operations with two numbers.
 *
 * Interface MathOperation
 * @package Math
 */
interface MathOperation extends NumberOperation
{
    /**
     * @return Parameter
     */
    public function getParam2();
}
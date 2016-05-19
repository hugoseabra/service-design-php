<?php

namespace Service\Pricing\Math;

use Service\Pricing\NumberResultable;

/**
 * Defines an object which supports mathematical result by defining the resulting type.
 *
 * Interface MathResult
 * @package Service\Pricing\Math\Result
 */
interface MathResult extends NumberResultable
{
    /**
     * @return StrictType
     */
    public function getResultType();

    /**
     * @return string
     */
    public function __toString();
}
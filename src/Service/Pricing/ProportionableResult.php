<?php

namespace Service\Pricing;

use Service\Pricing\Math\MathResult;

/**
 * Defines an object which is a result of a mathematical operation and its creation consists in a proportionable result
 * by have an ordinary result and a proportionable one.
 *
 * Interface ProportionableResult
 * @package Service\Pricing
 */
interface ProportionableResult
{
    /**
     * @return MathResult
     */
    public function getProportionalResult();

    /**
     * @return MathResult
     */
    public function getResult();
}
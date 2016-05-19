<?php

namespace Service\Pricing;

/**
 * Defines an object which supports a result of a recent mathematical operation.
 *
 * Interface NumberResultable
 * @package Service\Pricing
 */
interface NumberResultable
{
    /**
     * @return float|int|double
     */
    public function getValue();

    /**
     * @param float|int|double $value
     */
    public function setValue($value);
}
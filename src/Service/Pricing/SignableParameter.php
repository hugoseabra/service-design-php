<?php

namespace Service\Pricing;

/**
 * Defines an object which supports signal information as part of its behavior.
 *
 * Interface SignableParameter
 * @package Service\Pricing
 */
interface SignableParameter
{
    /**
     * @return string
     */
    public function getSignal();
}
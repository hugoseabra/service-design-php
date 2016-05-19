<?php

namespace Service\Pricing;

/**
 * Defines an object which supports persisted proportionable parameters.
 *
 * Interface Proportionable
 * @package Service\Pricing
 */
interface Proportionable
{
    /**
     * @param Parameter $proportionalParameter
     * @return $this
     */
    public function setProportionalParameter(Parameter $proportionalParameter);

    /**
     * @return Parameter|SignableParameter
     */
    public function getProportionalParameter();
}
<?php

namespace Service\Pricing;

use Util\Collection;

/**
 * Defines a Parameterizable object wich supports behaviors based on persisted parameters.
 *
 * Interface Parameterizable
 * @package Service\Pricing
 */
interface Parameterizable
{
    /**
     * @return Collection
     */
    public function getInputParameters();

    /**
     * @param Parameter $parameter
     * @return $this
     */
    public function addInputParameter(Parameter $parameter);

    /**
     * @param string $code
     * @param int|float|double $value
     * @return $this
     */
    public function input($code, $value);
}
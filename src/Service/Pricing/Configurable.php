<?php

namespace Service\Pricing;

use Util\Collection;

/**
 * Defines a configurable object which supports a behavior based on persisted configuration.
 *
 * Interface Configurable
 * @package Service\Pricing
 */
interface Configurable
{
    /**
     * @return Collection
     */
    public function getConfigurations();

    /**
     * @param Parameter $configuration
     * @return $this
     */
    public function addConfiguration(Parameter $configuration);
}
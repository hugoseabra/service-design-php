<?php

namespace Service\Pricing;

use Service\Pricing\ServiceResource\ServiceResource;
use Service\Processable;
use Service\Service;
use Util\Collection;

/**
 * Defines the specialization of a server by using it as pricing intelligent of a root subsystem (Service Pricing),
 * supporting to be mathematical operated, configured, parameterized, proportionable resulted.
 *
 * Interface ServicePricing
 * @package Service\Pricing
 */
interface ServicePricing extends Service, Processable, Configurable, Parameterizable, Proportionable
{
    /**
     * @return Collection
     */
    public function getResources();

    /**
     * @param ServiceResource $resource
     * @return Service
     */
    public function addResource(ServiceResource $resource);

    /**
     * Adds a link from Service Configuration to Resource Input Parameter.
     * @param string $serviceConfigCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromConfigurationToResource($serviceConfigCode, $resourceCode, $resourceInputCode);

    /**
     * Adds a link from Service Input to Resource Input Parameter.
     * @param string $serviceInputCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromInputToResource($serviceInputCode, $resourceCode, $resourceInputCode);

    /**
     * Adds a link from Resource Result value to Resource Input Parameter.
     * @param string $operationalResourceCode
     * @param string $resourceCode
     * @param string $resourceInputCode
     */
    public function addLinkFromOperationalResourceToResource($operationalResourceCode, $resourceCode, $resourceInputCode);

    /**
     * @return ProportionableResult
     */
    public function getPrice();
}
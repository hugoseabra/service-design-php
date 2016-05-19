<?php

namespace Service\Pricing\ServiceResource;

use Service\Pricing\Indicator;

interface ResourceFinancialResult
{
    /**
     * @return Indicator
     */
    public function getKey();

    /**
     * @return Indicator
     */
    public function getProportionalKey();
}
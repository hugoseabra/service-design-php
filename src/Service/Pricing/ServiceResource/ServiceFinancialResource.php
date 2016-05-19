<?php

namespace Service\Pricing\ServiceResource;

use Service\Pricing\Formattable;
use Service\Pricing\Proportionable;

interface ServiceFinancialResource extends ServiceResource, Proportionable, Formattable
{
    /**
     * @return ResourceFinancialResult
     */
    public function getResult();

    /**
     * @param float|double|int $value
     * @return $this
     */
    public function inputProportionalValue($value);
}
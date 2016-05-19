<?php

namespace Implementation\Service\Pricing\ServiceResource;

use Service\Pricing\ServiceResource\ResourceFinancialResult as ResourceFinancialResultInterface;
use Service\Pricing\Indicator;

class ResourceFinancialResult implements ResourceFinancialResultInterface
{
    /**
     * @var Indicator
     */
    protected $key;

    /**
     * @var Indicator
     */
    protected $proportionalKey;

    /**
     * ResourceFinancialResult constructor.
     * @param Indicator $key
     * @param Indicator $proportionalKey
     */
    public function __construct(Indicator $key, Indicator $proportionalKey)
    {
        $this->key = $key;
        $this->proportionalKey = $proportionalKey;
    }

    /**
     * @return Indicator
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return Indicator
     */
    public function getProportionalKey()
    {
        return $this->proportionalKey;
    }
}
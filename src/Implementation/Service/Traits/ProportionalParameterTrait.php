<?php

namespace Implementation\Service\Traits;

use Implementation\Service\Pricing\Parameter\ProportionalParameter;
use Service\Pricing\Math\StrictType;
use Service\Pricing\Parameter;

trait ProportionalParameterTrait
{
    /**
     * @var ProportionalParameter
     */
    protected $proportionalParameter;

    /**
     * @param Parameter $proportionalParameter
     * @return $this
     */
    public function setProportionalParameter(Parameter $proportionalParameter)
    {
        $this->proportionalParameter = $proportionalParameter;
        RETURN $this;
    }

    /**
     * @return ProportionalParameter
     */
    public function getProportionalParameter()
    {
        return $this->proportionalParameter;
    }

    /**
     * @return StrictType
     */
    public function getProportionalValue()
    {
        return $this->proportionalParameter->getValue();
    }

    /**
     * @param float|int $value
     * @return $this
     */
    public function inputProportionalValue($value)
    {
        $this->proportionalParameter->updateValue($value);
        return $this;
    }
}
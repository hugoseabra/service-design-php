<?php

namespace Implementation\Service\Pricing\Math;

use Implementation\Service\Traits\NumberResultableTrait;
use Service\Pricing\Math\MathResult as MathResultInterface;
use Service\Pricing\Math\StrictType;

class MathResult implements MathResultInterface
{
    use NumberResultableTrait;

    /**
     * @var StrictType
     */
    protected $resultType;

    /**
     * @var string
     */
    protected $maskedValue;

    /**
     * AbstractMathResult constructor.
     * @param StrictType $resultType
     */
    public function __construct(StrictType $resultType)
    {
        $this->resultType = $resultType;
        $this->value = $resultType->getValue();
        $this->maskedValue = $resultType->getMaskedValue();
    }

    /**
     * @return StrictType
     */
    public function getResultType()
    {
        return $this->resultType;
    }

    /**
     * @return string
     */
    public function getMaskedValue()
    {
        return $this->maskedValue;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->resultType;
    }
}
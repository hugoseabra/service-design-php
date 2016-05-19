<?php

namespace Implementation\Service\Pricing\Parameter;

use Implementation\Service\Traits\NameableTrait;
use Implementation\Service\Traits\NumberResultableTrait;
use Implementation\Service\Traits\ReferenceableTrait;
use Service\Pricing\Math\Operation\NumberOperation;
use Service\Pricing\Math\Operation\MathOperation;
use Service\Pricing\Math\StrictType;
use Service\Pricing\Math\MathResult;
use Service\Pricing\Math\Formatter;
use Service\Pricing\Indicator;

class Key implements Indicator
{
    use NameableTrait;
    use ReferenceableTrait;
    use NumberResultableTrait;

    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * @var NumberOperation
     */
    protected $mathOperation;

    /**
     * Key constructor.
     * @param string $name
     * @param string $code
     * @param NumberOperation|MathOperation $mathOperation
     */
    public function __construct($name, $code, NumberOperation $mathOperation)
    {
        $this->name = $name;
        $this->code = $code;
        $this->mathOperation = $mathOperation;
    }

    /**
     * @return StrictType
     */
    public function getStrictType()
    {
        return $this->mathOperation->getResult()->getResultType();
    }

    /**
     * @return NumberOperation|MathOperation
     */
    public function getMathOperation()
    {
        return $this->mathOperation;
    }

    /**
     * @param NumberOperation|MathOperation $mathOperation
     */
    public function updateMathOperation(NumberOperation $mathOperation)
    {
        $this->mathOperation = $mathOperation;
    }

    public function process()
    {
        $this->mathOperation->process();
    }

    /**
     * @return MathResult
     */
    public function getResult()
    {
        return $this->mathOperation->getResult();
    }

    /**
     * @return float|int|double
     */
    public function getValue()
    {
        return $this->getResult()->getValue();
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->code;
    }

    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
        $this->mathOperation->setFormatter($formatter);
    }

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @return string
     */
    public function getMaskedValue()
    {
        $value = $this->getValue();
        return ($this->formatter) ? $this->formatter->format($value) : $value;
    }
}

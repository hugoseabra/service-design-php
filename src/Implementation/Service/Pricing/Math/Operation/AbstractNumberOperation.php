<?php

namespace Implementation\Service\Pricing\Math\Operation;

use Implementation\Service\Pricing\Math\StrictType\DoubleType;
use Implementation\Service\Pricing\Math\StrictType\FloatType;
use Implementation\Service\Pricing\Math\StrictType\IntegerType;
use Implementation\Service\Pricing\Math\StrictType\MoneyType;
use Implementation\Service\Traits\FormattableTrait;
use Implementation\Service\Traits\MathCommonMethods;
use Implementation\Service\Pricing\Math\MathResult;
use Service\Pricing\Math\Operation\NumberOperation;
use Service\Pricing\Math\Formatter;
use Service\Pricing\Parameter;

abstract class AbstractNumberOperation implements NumberOperation
{
    use MathCommonMethods;
    use FormattableTrait;

    /**
     * AbstractMathOperation constructor.
     * @param Parameter $param1
     * @param Formatter $formatter
     */
    public function __construct(Parameter $param1, Formatter $formatter = null)
    {
        $this->param1 = $param1;
        $this->formatter = $formatter;
    }

    /**
     * @return MathResult
     */
    public function getResult()
    {
        $this->retrieveResult();
        return $this->result;
    }

    /**
     * @return MathResult
     * @throws \Exception
     */
    protected function retrieveResult()
    {
        $variable1 = $this->param1->getStrictType();

        $result = $this->operate($variable1->getValue());
        $resultType = new FloatType($result, $this->formatter);

        $this->result = new MathResult($resultType);
    }

    /**
     * @param float|double|integer $var1
     * @return float|double|integer
     */
    abstract protected function operate($var1);
}
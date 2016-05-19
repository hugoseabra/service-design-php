<?php

namespace Implementation\Service\Pricing\Math\Operation;

use Implementation\Service\Pricing\Math\StrictType\DoubleType;
use Implementation\Service\Pricing\Math\StrictType\FloatType;
use Implementation\Service\Pricing\Math\StrictType\IntegerType;
use Implementation\Service\Pricing\Math\StrictType\MoneyType;
use Implementation\Service\Traits\FormattableTrait;
use Implementation\Service\Traits\MathCommonMethods;
use Implementation\Service\Pricing\Math\MathResult;
use Service\Pricing\Math\Operation\MathOperation;
use Service\Pricing\Math\Formatter;
use Service\Pricing\Parameter;

abstract class AbstractMathOperation implements MathOperation
{
    use MathCommonMethods;
    use FormattableTrait;

    /**
     * @var Parameter
     */
    protected $param2;

    /**
     * AbstractMathOperation constructor.
     * @param Parameter $param1
     * @param Parameter $param2
     */
    public function __construct(Parameter $param1, Parameter $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    /**
     * @return Parameter
     */
    public function getParam2()
    {
        return $this->param2;
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
     * @throws \Exception
     */
    public function process()
    {
        $this->retrieveResult();
    }

    /**
     * @return MathResult
     * @throws \Exception
     */
    protected function retrieveResult()
    {
        $variable1 = $this->param1->getStrictType();
        $variable2 = $this->param2->getStrictType();

        $result = $this->calculate($variable1->getValue(), $variable2->getValue());

        /**
         * - Float <operation> Float: float
         * - Float <operation> Integer: float
         * - Double <operation> Double: double
         * - Double <operation> Float: double
         * - Double <operation> Integer: double
         * - Integer <operation> Integer: integer
         * - Money <operation> Money: money
         * - Money <operation> Float: money
         * - Money <operation> Double: money
         * - Money <operation> Integer: money
         */
        $resultType = null;
        switch (true) {
            case ((string)$variable1 == 'float' && (string)$variable2 == 'float'):
            case ((string)$variable1 == 'float' && (string)$variable2 == 'integer'):
            case ((string)$variable1 == 'integer' && (string)$variable2 == 'float'):
                $resultType = new FloatType($result);
                break;
            case ((string)$variable1 == 'double' && (string)$variable2 == 'double'):
            case ((string)$variable1 == 'double' && (string)$variable2 == 'float'):
            case ((string)$variable1 == 'double' && (string)$variable2 == 'integer'):
            case ((string)$variable1 == 'float' && (string)$variable2 == 'double'):
            case ((string)$variable1 == 'integer' && (string)$variable2 == 'double'):
                $resultType = new DoubleType($result);
                break;
            case ((string)$variable1 == 'integer' && (string)$variable2 == 'integer'):
                $resultType = new IntegerType($result);
                break;
            case ((string)$variable1 == 'money' && (string)$variable2 == 'money'):
            case ((string)$variable1 == 'money' && (string)$variable2 == 'float'):
            case ((string)$variable1 == 'money' && (string)$variable2 == 'double'):
            case ((string)$variable1 == 'money' && (string)$variable2 == 'integer'):
            case ((string)$variable1 == 'float' && (string)$variable2 == 'money'):
            case ((string)$variable1 == 'double' && (string)$variable2 == 'money'):
            case ((string)$variable1 == 'integer' && (string)$variable2 == 'money'):
                $resultType = new MoneyType($result);
                break;
            default:
                throw new \Exception('Result type of math operation was not identified.');
        }

        if ($this->formatter) {
            $resultType->setFormatter($this->formatter);
        }

        $this->result = new MathResult($resultType);
    }

    /**
     * @param float|double|integer $var1
     * @param float|double|integer $var2
     * @return float|double|integer
     */
    abstract protected function calculate($var1, $var2);
}
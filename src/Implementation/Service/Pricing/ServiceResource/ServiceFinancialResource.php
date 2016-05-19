<?php

namespace Implementation\Service\Pricing\ServiceResource;

use Implementation\Service\Pricing\Math\MathOperationFactory;
use Implementation\Service\Pricing\Parameter\ParameterFactory;
use Implementation\Service\Traits\ProportionalParameterTrait;
use Implementation\Service\Pricing\Math\FormatterFactory;
use Implementation\Service\Traits\FormattableTrait;

use Service\Pricing\ServiceResource\ServiceFinancialResource as FinancialResourceInterface;
use Service\Pricing\Math\Operation\MathOperation;
use Service\Pricing\Proportionable;
use Service\Pricing\Parameter;
use Service\Pricing\Indicator;
use Service\Pricing\SignableParameter;

class ServiceFinancialResource extends AbstractServiceResource implements FinancialResourceInterface
{
    use ProportionalParameterTrait;
    use FormattableTrait;

    public function __construct($name, $code, $description = null, $goal = null)
    {
        parent::__construct($name, $code, $description, $goal);
        $this->setFormatter(FormatterFactory::create('money'));
    }

    /**
     * @return ResourceFinancialResult
     */
    public function getResult()
    {
        $this->process();
        return $this->retrieveResult();
    }

    /**
     * Processes math operations.
     */
    public function process()
    {
        /**
         * @var Indicator $key
         */
        foreach ($this->keys as $key) {
            $this->updateProportionalParameterMathOperation($key);
            $key->process();
        }
    }


    /**
     * @return ResourceFinancialResult
     */
    protected function retrieveResult()
    {
        if (!$this->proportionalParameter) {
            return null;
        }

        /**
         * @var Indicator $lastKey
         */
        $lastKey = end($this->keys->getIterator()->getArrayCopy());

        /**
         * @var MathOperation $mathOperation
         */
        $mathOperation = $lastKey->getMathOperation();
        $resultKey = $this->getMainResult($mathOperation->getParam1(), $mathOperation->getParam2(), (string)$mathOperation);
        $proportionalKey = $this->getProportionalResult($lastKey, $this->proportionalParameter);

        return new ResourceFinancialResult($resultKey, $proportionalKey);
    }

    /**
     * @param Parameter $param1
     * @param Parameter $param2
     * @param string $operationName
     * @return Indicator
     */
    protected function getMainResult(Parameter $param1, Parameter $param2, $operationName = null)
    {
        $mainResult = ParameterFactory::createKey(
            'Valor Total',
            'valor-total',
            $operationName,
            $param1,
            $param2
        );
        $mainResult->setFormatter($this->formatter);

        return $mainResult;
    }

    /**
     * @param Parameter $param1
     * @param Parameter $param2
     * @return Indicator
     */
    protected function getProportionalResult(Parameter $param1, Parameter $param2)
    {
        $proportionalKey = ParameterFactory::createKey(
            'Valor por '.$this->proportionalParameter->getSignal(),
            'valor-por-'.$this->proportionalParameter->getSignal(),
            'division',
            $param1,
            $param2
        );
        $proportionalKey->setFormatter($this->formatter);
        return $proportionalKey;
    }

    /**
     * @param Indicator $key
     */
    protected function updateProportionalParameterMathOperation(Indicator $key)
    {
        $mathOperation = $key->getMathOperation();

        $param1 = $mathOperation->getParam1();
        $param2 = $mathOperation->getParam2();

        $update = false;
        if ($param1 instanceof SignableParameter) {
            $param1 = $this->proportionalParameter;
            $update = true;
        }

        if ($param2 instanceof SignableParameter) {
            $param2 = $this->proportionalParameter;
            $update = true;
        }

        if ($update) {
            $mathOperation = MathOperationFactory::create((string)$mathOperation, $param1, $param2);
            $key->updateMathOperation($mathOperation);
        }
    }
}
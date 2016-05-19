<?php

namespace Implementation\Service\Traits;

use Implementation\Service\Pricing\Parameter\InputParameter;
use Service\Pricing\Parameter;
use Util\Collection;

trait ParameterizableTrait
{
    /**
     * @var Collection
     */
    protected $configurations;

    /**
     * @var Collection
     */
    protected $inputParameters;

    /**
     * @return Collection
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }

    /**
     * @param Parameter $config
     * @return $this
     */
    public function addConfiguration(Parameter $config)
    {
        $this->configurations->offsetSet($config->getCode(), $config);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getInputParameters()
    {
        return $this->inputParameters;
    }

    /**
     * @param Parameter $parameter
     * @return $this
     */
    public function addInputParameter(Parameter $parameter)
    {
        $this->inputParameters->offsetSet($parameter->getCode(), $parameter);
        return $this;
    }

    /**
     * @param string $code
     * @param int|float|double $value
     * @return $this
     * @throws \Exception
     */
    public function input($code, $value)
    {
        if (!$input = $this->findInputParameter($code)) {
            throw new \Exception('There is no input parameter with code "'.$code.'"');
        }
        $input->setValue($value);
        return $this;
    }

    protected function initializeCollections()
    {
        $this->inputParameters = new Collection();
        $this->configurations = new Collection();
    }

    protected function findInputParameter($code)
    {
        $it = $this->inputParameters->getIterator();
        $it->rewind();

        /**
         * @var InputParameter $input
         */
        $foundInputParameter = null;
        while($it->valid()) {
            $input = $it->current();
            if ($input->getCode() == $code) {
                $foundInputParameter = $input;
            }
            $it->next();
        }
        return $foundInputParameter;
    }
}
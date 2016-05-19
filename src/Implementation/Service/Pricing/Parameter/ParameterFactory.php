<?php

namespace Implementation\Service\Pricing\Parameter;

use Implementation\Service\Pricing\Math\FormatterFactory;
use Implementation\Service\Pricing\Math\MathOperationFactory;
use Implementation\Service\Pricing\Math\StrictTypeFactory;
use Service\Pricing\Parameter;

class ParameterFactory
{
    /**
     * @param string $name
     * @param string $code
     * @param string $type
     * @param string $formatterName
     * @param int|float|double $value
     * @return Configuration
     */
    public static function createConfiguration($name, $code, $type, $value, $formatterName = null)
    {
        $parameter = new Configuration($name, $code, StrictTypeFactory::create($type, $value));
        if ($formatterName && $formatter = FormatterFactory::create($formatterName)) {
            $parameter->setFormatter($formatter);
        }
        return $parameter;
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $type
     * @param string $signal
     * @param string $formatterName
     * @return ProportionalParameter
     */
    public static function createProportional($name, $code, $type, $signal, $formatterName = null)
    {
        $parameter = new ProportionalParameter($name, $code, StrictTypeFactory::create($type, 0), $signal);
        if ($formatterName && $formatter = FormatterFactory::create($formatterName)) {
            $parameter->setFormatter($formatter);
        }
        return $parameter;
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $type
     * @param string $formatterName
     * @return InputParameter
     */
    public static function createInput($name, $code, $type, $formatterName = null)
    {
        $parameter = new InputParameter($name, $code, StrictTypeFactory::create($type, 0));
        if ($formatterName && $formatter = FormatterFactory::create($formatterName)) {
            $parameter->setFormatter($formatter);
        }
        return $parameter;
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $mathOperation
     * @param Parameter $param1
     * @param Parameter $param2
     * @param string $formatterName
     * @return Key
     */
    public static function createKey(
        $name,
        $code,
        $mathOperation,
        Parameter $param1,
        Parameter $param2 = null,
        $formatterName = null
    ) {
        $parameter = new Key($name, $code, MathOperationFactory::create($mathOperation, $param1, $param2));
        if ($formatterName && $formatter = FormatterFactory::create($formatterName)) {
            $parameter->setFormatter($formatter);
        }
        return $parameter;
    }
}
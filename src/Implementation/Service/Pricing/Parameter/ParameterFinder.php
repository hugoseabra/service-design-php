<?php

namespace Implementation\Service\Pricing\Parameter;

use Service\Pricing\ServiceResource\ServiceFinancialResource as FinancialResource;
use Service\Pricing\ServiceResource\ServiceResource;
use Service\Pricing\ServicePricing;
use Service\Pricing\Parameter;
use Util\Collection;

class ParameterFinder
{
    /**
     * @param ServicePricing $service
     * @param string $code
     * @return Parameter
     * @throws \Exception
     */
    public static function findFromService(ServicePricing $service, $code)
    {
        self::checkPrefix($code, $service);
        $method = self::getMethod($code);
        return self::getParameter($method, $service, $code);
    }

    /**
     * @param ServiceResource $resource
     * @param string $code
     * @return Parameter
     * @throws \Exception
     */
    public static function findFromResource(ServiceResource $resource, $code)
    {
        self::checkPrefix($code, $resource);
        $method = self::getMethod($code);
        return self::getParameter($method, $resource, $code);
    }

    /**
     * @param string $code
     * @return string
     * @throws \Exception
     */
    protected static function getMethod($code)
    {
        $exp = explode('-', $code);
        $prefix = $exp[0];

        $method = null;
        switch (true) {
            case ($prefix == 'input'):
                $method = 'getInputParameters';
                break;
            case ($exp[0] == 'config'):
                $method = 'getConfigurations';
                break;
            case ($exp[0] == 'key'):
                $method = 'getKeys';
                break;
            case ($exp[0] == 'prop'):
                $method = 'getProportionalParameters';
                break;
            default:
                throw new \Exception('Code sem prefixo reconhecido em "'.$code.'": input-, config- ou key-');
        }

        return $method;
    }

    protected static function checkObject($object)
    {
        if (!is_object($object)) {
            throw new \Exception('Trying to find parameter from a non-object');
        }
    }

    /**
     * @param string $code
     * @param object $object
     * @throws \Exception
     */
    protected static function checkPrefix($code, $object)
    {
        self::checkObject($object);

        $exp = explode('-', $code);
        $prefix = $exp[0];

        if ($prefix == 'prop-' && (!$object instanceof FinancialResource || !$object instanceof ServicePricing)) {
            throw new \Exception('Tentando resgatar parâmetro com prefixo "prop-" em um recurso ou serviço diferente do financeiro');
        }
    }

    /**
     * @param string $method
     * @param object $object
     * @param string $code
     * @return Parameter
     * @throws \Exception
     */
    protected static function getParameter($method, $object, $code)
    {
        self::checkObject($object);

        $class = get_class($object);
        $method = new \ReflectionMethod($class, $method);

        /**
         * @var Collection $parameters
         */
        $parameters = $method->invoke($object);

        $it = $parameters->getIterator();
        $it->rewind();

        /**
         * @var Parameter $parameter
         */
        $foundParameter = null;
        while($it->valid()) {
            $parameter = $it->current();
            if ($parameter->getCode() == $code) {
                $foundParameter = $parameter;
            }
            $it->next();
        }

        if (!$foundParameter) {
            throw new \Exception('Nenhum parêmetro com código "'.$code.'" no recurso "'.$class.'"');
        }

        return $foundParameter;
    }
}
<?php

namespace Implementation\Service\Pricing\Math;


use Service\Pricing\Math\Operation\MathOperation;
use Service\Pricing\Parameter;

class MathOperationFactory
{
    /**
     * @param string $operation
     * @param Parameter $param1
     * @param Parameter $param2
     * @return MathOperation
     * @throws \Exception
     */
    public static function create($operation, Parameter $param1, Parameter $param2 = null)
    {
        $ref = new \ReflectionClass(self::getNamespace($operation));
        return $ref->newInstance($param1, $param2);
    }

    /**
     * @param string $operation
     * @return string
     * @throws \Exception
     */
    protected static function getNamespace($operation)
    {
        $namespace = '\\Implementation\\Service\\Pricing\\Math\\Operation\\';
        switch ($operation) {
            case 'adition':
                $namespace .= 'Adition';
                break;
            case 'substraction':
                $namespace .= 'Substraction';
                break;
            case 'multiplication':
                $namespace .= 'Multiplication';
                break;
            case 'division':
                $namespace .= 'Division';
                break;
            case 'square':
                $namespace .= 'Square';
                break;
            default:
                throw new \Exception('Operation "'.$operation.'" is not valid for creating a Math Operation object.');
        }
        return $namespace;
    }
}
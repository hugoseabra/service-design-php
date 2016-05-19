<?php

namespace Implementation\Service\Pricing\Math;

use Service\Pricing\Math\StrictType;

class StrictTypeFactory
{
    /**
     * @param string $type
     * @param float|double|int $value
     * @return StrictType
     * @throws \Exception
     */
    public static function create($type, $value)
    {
        $ref = new \ReflectionClass(self::getNamespace($type));
        return $ref->newInstance($value);
    }

    /**
     * @param string $type
     * @return string
     * @throws \Exception
     */
    protected static function getNamespace($type)
    {
        $namespace = '\\Implementation\\Service\\Pricing\\Math\\StrictType\\';
        switch ($type) {
            case 'double':
                $namespace .= 'DoubleType';
                break;
            case 'float':
                $namespace .= 'FloatType';
                break;
            case 'integer':
                $namespace .= 'IntegerType';
                break;
            case 'money':
                $namespace .= 'MoneyType';
                break;
            default:
                throw new \Exception("Type '{$type}' is not valid to create StrictType object.");
        }
        return $namespace;
    }
}
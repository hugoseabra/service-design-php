<?php

namespace Implementation\Service\Pricing\Math;

use Service\Pricing\Math\Formatter;

class FormatterFactory
{
    /**
     * @param string $type
     * @return Formatter
     * @throws \Exception
     */
    public static function create($type)
    {
        $ref = new \ReflectionClass(self::getNamespace($type));
        return $ref->newInstance();
    }

    /**
     * @param string $type
     * @return string
     * @throws \Exception
     */
    protected static function getNamespace($type)
    {
        $namespace = '\\Implementation\\Service\\Pricing\\Math\\Formatter\\';
        switch ($type) {
            case 'ceil':
            case 'ceiling':
            case 'teto':
                $namespace .= 'CeilFormatter';
                break;
            case 'floor':
            case 'piso':
                $namespace .= 'FloorFormatter';
                break;
            case 'money':
                $namespace .= 'MoneyFormatter';
                break;
            case 'percent':
                $namespace .= 'PercentFormatter';
                break;
            case 'decimal':
                $namespace .= 'DecimalFormatter';
                break;
            case 'number':
                $namespace .= 'NumberFormatter';
                break;
            default:
                throw new \Exception('Type "'.$type.'" is not valid for creating a Formatter object.');
        }
        return $namespace;
    }
}
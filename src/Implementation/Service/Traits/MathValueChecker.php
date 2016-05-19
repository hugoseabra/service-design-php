<?php

namespace Implementation\Service\Traits;

trait MathValueChecker
{
    /**
     * @param mixed $value
     * @throws \Exception
     */
    protected function checkValueRestriction($value)
    {
        if (is_object($value) || is_array($value)) {
            throw new \Exception('Value must not be an object or an array');
        }
    }
}
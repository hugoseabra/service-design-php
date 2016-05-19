<?php

namespace Service\Pricing\Math\Operation;

use Service\Pricing\Math\MathResult;
use Service\Pricing\Formattable;
use Service\Pricing\Parameter;
use Service\Processable;

/**
 * Defines an object which supports math operations with one number.
 *
 * Interface NumberOperation
 * @package Math\Operation
 */
interface NumberOperation extends Formattable, Processable
{
    /**
     * @return Parameter
     */
    public function getParam1();

    /**
     * @return MathResult
     */
    public function getResult();

    /**
     * @return string
     */
    public function __toString();
}
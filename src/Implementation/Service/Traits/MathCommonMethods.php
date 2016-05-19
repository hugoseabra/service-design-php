<?php

namespace Implementation\Service\Traits;

use Service\Pricing\Math\MathResult;
use Service\Pricing\Math\Formatter;
use Service\Pricing\Parameter;

trait MathCommonMethods
{
    /**
     * @var Parameter
     */
    protected $param1;

    /**
     * @var MathResult
     */
    protected $result;

    /**
     * @return Parameter
     */
    public function getParam1()
    {
        return $this->param1;
    }
}
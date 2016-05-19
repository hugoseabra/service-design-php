<?php

namespace Implementation\Service\Pricing\Math\StrictType;

use Implementation\Service\Traits\FormattableTrait;
use Implementation\Service\Traits\MathValueChecker;
use Service\Pricing\Math\StrictType;
use Service\Pricing\Math\Formatter;

abstract class AbstractStrictType implements StrictType
{
    use MathValueChecker;
    use FormattableTrait;

    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * FloatType constructor.
     * @param float|double|integer $value
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->checkValueRestriction($value);
        $this->value = $value;
    }
}
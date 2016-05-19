<?php

namespace Implementation\Service\Pricing\Math\StrictType;

class FloatType extends AbstractStrictType
{
    /**
     * @var float
     */
    protected $value;

    /**
     * FloatType constructor.
     * @param float|double|int|string $value
     */
    public function __construct($value)
    {
        parent::__construct(floatval($value));
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float|int $value
     * @return $this
     */
    public function updateValue($value)
    {
        $this->value = floatval($value);
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return is_float($this->value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'float';
    }
}
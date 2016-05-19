<?php

namespace Implementation\Service\Pricing\Math\StrictType;

class DoubleType extends AbstractStrictType
{
    /**
     * @var double
     */
    protected $value;

    /**
     * DoubleType constructor.
     * @param float|double|int|string $value
     */
    public function __construct($value)
    {
        parent::__construct(doubleval($value));
    }


    /**
     * @return double
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
        $this->value = doubleval($value);
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return is_double($this->value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'double';
    }
}
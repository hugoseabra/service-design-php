<?php

namespace Implementation\Service\Pricing\Math\StrictType;

class IntegerType extends AbstractStrictType
{
    /**
     * @var integer
     */
    protected $value;

    /**
     * IntegerType constructor.
     * @param float|double|int|string $value
     */
    public function __construct($value)
    {
        parent::__construct(intval($value));
    }

    /**
     * @return integer
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
        $this->value = intval($value);
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return is_int($this->value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'integer';
    }
}
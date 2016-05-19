<?php

namespace Implementation\Service\Traits;

trait NumberResultableTrait
{
    /**
     * @var int|float|double
     */
    protected $value;

    /**
     * @return float|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float|int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
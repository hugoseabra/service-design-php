<?php

namespace Implementation\Service\Pricing\Parameter;

use Implementation\Service\Traits\ReferenceableTrait;
use Implementation\Service\Traits\FormattableTrait;
use Implementation\Service\Traits\NameableTrait;
use Service\Pricing\Math\StrictType;
use Service\Pricing\Parameter;

abstract class AbstractParameter implements Parameter
{
    use NameableTrait;
    use ReferenceableTrait;
    use FormattableTrait;

    /**
     * @var StrictType
     */
    protected $strictType;

    /**
     * AbstractParameter constructor.
     * @param string $name
     * @param string $code
     * @param StrictType $strictType
     */
    public function __construct($name, $code, StrictType $strictType)
    {
        $this->name = $name;
        $this->code = $code;
        $this->strictType = $strictType;
        $this->value = $strictType->getValue();
    }

    /**
     * @return StrictType
     */
    public function getStrictType()
    {
        return $this->strictType;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->code;
    }
}

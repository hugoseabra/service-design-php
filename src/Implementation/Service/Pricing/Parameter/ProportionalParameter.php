<?php
namespace Implementation\Service\Pricing\Parameter;

use Service\Pricing\SignableParameter;
use Service\Pricing\Math\StrictType;

class ProportionalParameter extends AbstractParameter implements SignableParameter
{
    /**
     * @var string
     */
    protected $signal;

    /**
     * ProportionalParameter constructor.
     * @param string $name
     * @param string $code
     * @param StrictType $strictType
     * @param string $signal
     */
    public function __construct($name, $code, StrictType $strictType, $signal)
    {
        parent::__construct($name, $code, $strictType);
        $this->signal = $signal;
    }

    /**
     * @param int|float|double $value
     * @return $this
     */
    public function updateValue($value)
    {
        $this->strictType->updateValue($value);
        $this->value = $this->strictType->getValue();
        return $this;
    }

    /**
     * @return string
     */
    public function getSignal()
    {
        return $this->signal;
    }
}

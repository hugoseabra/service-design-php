<?php
namespace Implementation\Service\Pricing\Parameter;

class InputParameter extends AbstractParameter
{
    /**
     * @param int|float|double
     */
    public function setValue($value)
    {
        $this->replaceStrictType($value);
        $this->value = $this->strictType->getValue();
    }

    /**
     * @param string $value
     */
    protected function replaceStrictType($value)
    {
        $ref = new \ReflectionClass($this->strictType);
        $this->strictType = $ref->newInstance($value);
    }
}

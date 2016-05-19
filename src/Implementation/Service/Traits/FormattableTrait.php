<?php

namespace Implementation\Service\Traits;

use Service\Pricing\Math\Formatter;

trait FormattableTrait
{
    use NumberResultableTrait;

    /**
     * @var Formatter
     */
    protected $formatter;

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param Formatter $formatter
     */
    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return string
     */
    public function getMaskedValue()
    {
        return ($this->formatter) ? $this->formatter->format($this->value) : $this->value;
    }
}
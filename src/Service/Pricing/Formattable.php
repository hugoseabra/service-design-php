<?php

namespace Service\Pricing;

use Service\Pricing\Math\Formatter;

/**
 * Defines a formattable object which supports an exhibition of data according to masked value from format.
 *
 * Interface Formattable
 * @package Service\Pricing
 */
interface Formattable
{
    /**
     * @return Formatter
     */
    public function getFormatter();

    /**
     * @param Formatter $formatter
     */
    public function setFormatter(Formatter $formatter);

    /**
     * @return string
     */
    public function getMaskedValue();
}
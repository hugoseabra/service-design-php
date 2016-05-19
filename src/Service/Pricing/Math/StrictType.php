<?php

namespace Service\Pricing\Math;

use Service\Pricing\Formattable;

/**
 * Defines a variable type to ensure the information will have a strict value itself.
 *
 * Interface StrictType
 * @package Service\Pricing\Math\StrictType
 */
interface StrictType extends Formattable
{
    /**
     * @return boolean
     */
    public function isValid();

    /**
     * @param int|float|double $value
     * @return $this
     */
    public function updateValue($value);

    /**
     * @return integer|float|double
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString();
}
<?php

namespace Service\Pricing\Math;

/**
 * Defines a structure responsible for manipulation of Mathematical values.
 *
 * Interface Formatter
 * @package Service\Pricing\Math\Formatter
 */
interface Formatter
{
    /**
     * @param string $value
     * @return string
     */
    public function format($value);
}
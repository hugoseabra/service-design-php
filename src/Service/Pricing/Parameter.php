<?php

namespace Service\Pricing;

use Service\Pricing\Math\StrictType;
use Service\Referenceable;
use Service\Nameable;
use Util\Collectable;

/**
 * Defines an object which can be used as part of its behavior, supporting references, format, mathematical results
 * and to be named as part of business process.
 *
 * Interface Parameter
 * @package Service\Pricing
 */
interface Parameter extends Nameable, Referenceable, Formattable, Collectable, NumberResultable
{
    /**
     * @return StrictType
     */
    public function getStrictType();
}
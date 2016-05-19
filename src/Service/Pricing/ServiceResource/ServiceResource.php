<?php

namespace Service\Pricing\ServiceResource;

use Service\Pricing\Parameterizable;
use Service\Pricing\Configurable;
use Service\Pricing\Indicator;
use Service\Referenceable;
use Service\Consultable;
use Service\Processable;
use Util\Collectable;
use Util\Collection;

interface ServiceResource extends Consultable, Referenceable, Configurable, Parameterizable, Processable, Collectable
{
    /**
     * @return Collection
     */
    public function getKeys();

    /**
     * @param Indicator $key
     * @return $this
     */
    public function addKey(Indicator $key);

    /**
     * @return Indicator
     */
    public function getResult();
}
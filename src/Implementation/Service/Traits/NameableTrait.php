<?php

namespace Implementation\Service\Traits;


trait NameableTrait
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
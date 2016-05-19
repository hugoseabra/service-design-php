<?php

namespace Implementation\Service\Traits;


trait ConsultableTrait
{
    use NameableTrait;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $goal;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }
}
<?php
namespace Implementation\Service;

use Implementation\Service\Traits\ConsultableTrait;
use Service\Service as ServiceInterface;
use Util\Collectable;

class Service implements ServiceInterface
{
    use ConsultableTrait;

    /**
     * Service constructor.
     * @param string $name
     * @param string $description
     * @param string $goal
     */
    public function __construct($name, $description = null, $goal = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->goal = $goal;
    }
}
<?php

namespace Implementation\Service\Pricing\ServiceResource;

use Implementation\Service\Pricing\Parameter\ProportionalParameter;
use Implementation\Service\Traits\ReferenceableTrait;
use Service\Pricing\ServiceResource\ServiceResource as ResourceInterface;
use Service\Pricing\Indicator;

use Implementation\Service\Traits\ParameterizableTrait;
use Implementation\Service\Traits\ConsultableTrait;
use Util\Collection;

abstract class AbstractServiceResource implements ResourceInterface
{
    use ConsultableTrait;
    use ParameterizableTrait;
    use ReferenceableTrait;

    /**
     * @var Collection
     */
    protected $keys;

    /**
     * Service constructor.
     * @param string $name
     * @param string $code
     * @param string $description
     * @param string $goal
     */
    public function __construct($name, $code, $description = null, $goal = null)
    {
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->goal = $goal;

        $this->initializeCollections();
        $this->keys = new Collection();
    }

    /**
     * @return Collection
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @param Indicator $key
     * @return $this
     */
    public function addKey(Indicator $key)
    {
        $this->keys->add($key);
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->code;
    }

    /**
     * Processes math operations.
     */
    public function process()
    {
        /**
         * @var Indicator $key
         */
        foreach ($this->keys as $key) {
            $key->process();
        }
    }

    /**
     * @return Indicator
     */
    abstract protected function retrieveResult();
}
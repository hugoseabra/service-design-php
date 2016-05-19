<?php
namespace Util;

class Collection extends \ArrayObject
{
    /**
     * @param Collectable $item
     */
    public function add(Collectable $item)
    {
        $this->offsetSet($item->getKey(), $item);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return ($this->offsetExists($key)) ? $this->offsetGet($key) : null;
    }

    /**
     * @return array
     */
    public function getIndexes()
    {
        return array_keys($this->getIterator()->getArrayCopy());
    }
}
<?php
namespace Service;

/**
 * Defines an object which can be referenced by its attributes.
 *
 * Interface Referenceable
 * @package Service
 */
interface Referenceable
{
    /**
     * @return string
     */
    public function getCode();
}
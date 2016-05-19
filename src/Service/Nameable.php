<?php
namespace Service;

/**
 * Defines an objects which supports a name property as high level reference of business process.
 *
 * Interface Nameable
 * @package Service
 */
interface Nameable
{
    /**
     * @return string
     */
    public function getName();
}
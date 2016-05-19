<?php

namespace Service;


/**
 * Defines objects which can be consultable by understanding why it exists.
 *
 * Interface Consultable
 * @package Service
 */
interface Consultable extends Nameable
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getGoal();
}
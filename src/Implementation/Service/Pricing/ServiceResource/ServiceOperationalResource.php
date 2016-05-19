<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 16/05/16
 * Time: 19:01
 */

namespace Implementation\Service\Pricing\ServiceResource;

use Service\Pricing\ServiceResource\ServiceResource as OperationalResourceInterface;
use Service\Pricing\Indicator;

class ServiceOperationalResource extends AbstractServiceResource implements OperationalResourceInterface
{
    /**
     * @return Indicator
     */
    public function getResult()
    {
        $this->process();
        return $this->retrieveResult();
    }

    /**
     * @return Indicator
     */
    protected function retrieveResult()
    {
        return end($this->keys->getIterator()->getArrayCopy());
    }
}
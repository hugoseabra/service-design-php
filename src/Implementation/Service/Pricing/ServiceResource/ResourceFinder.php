<?php

namespace Implementation\Service\Pricing\ServiceResource;

use Service\Pricing\ServiceResource\ServiceFinancialResource as FinancialResource;
use Service\Pricing\ServiceResource\ServiceResource;
use Util\Collection;

class ResourceFinder
{
    /**
     * @param Collection $resources
     * @param string $code
     * @return ServiceResource|FinancialResource
     * @throws \Exception
     */
    public static function find(Collection $resources, $code)
    {
        $it = $resources->getIterator();
        $it->rewind();

        /**
         * @var ServiceResource|FinancialResource $resource
         */
        while($it->valid()) {

            $resource = $it->current();
            if ($resource->getCode() == $code) {
                return $resource;
            }
            $it->next();
        }

        throw new \Exception('Nenhum recurso com o código "'.$code.'"');
    }
}
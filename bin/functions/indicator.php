<?php
include_once __DIR__.'/util/finder.php';

$addKeys = function(\Service\Pricing\ServiceResource\ServiceResource $resource, array $keys) use ($findParameter) {
    foreach ($keys as $key) {
        $keyParameter = \Implementation\Service\Pricing\Parameter\ParameterFactory::createKey(
            $key['name'],
            $key['code'],
            $key['operation'],
            $findParameter($resource, $key['param1']),
            $findParameter($resource, $key['param2']),
            $key['formatter']
        );
        $resource->addKey($keyParameter);
    }
};
<?php
include_once __DIR__.'/../../autoload.php';
include_once __DIR__.'/parameter.php';
include_once __DIR__.'/indicator.php';

$createOperationalResource = function($name, $code, $filePath) use ($addKeys, $addConfigs, $addInputs) {
    $parser = new \Symfony\Component\Yaml\Parser();
    $data = $parser->parse(file_get_contents($filePath));

    $resource = new \Implementation\Service\Pricing\ServiceResource\ServiceOperationalResource($name, $code);
    $addConfigs($resource, $data['configurations'] ?: []);
    $addInputs($resource, $data['inputs'] ?: []);
    $addKeys($resource, $data['keys'] ?: []);

    return $resource;
};

$createFinancialResource = function($name, $code, $filePath) use ($addConfigs, $addInputs, $addKeys, $addProportional) {
    $parser = new \Symfony\Component\Yaml\Parser();
    $data = $parser->parse(file_get_contents($filePath));

    $resource = new \Implementation\Service\Pricing\ServiceResource\ServiceFinancialResource($name, $code);

    $addProportional($resource, $data['proportional'] ?: []);
    $addConfigs($resource, $data['configurations'] ?: []);
    $addInputs($resource, $data['inputs'] ?: []);
    $addKeys($resource, $data['keys'] ?: []);

    return $resource;
};
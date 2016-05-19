<?php
include_once __DIR__.'/../../autoload.php';
include_once __DIR__.'/util/template.php';
include_once __DIR__.'/parameter.php';

$addTransition = function($service, array $transition, $type) {
    $method = null;
    switch ($type) {
        case 'fromConfig':
            $method = 'addLinkFromConfigurationToResource';
            break;
        case 'fromInput':
            $method = 'addLinkFromInputToResource';
            break;
        case 'fromResource':
            $method = 'addLinkFromOperationalResourceToResource';
            break;
        default:
            throw new \Exception('Erro ao inserir transição: "'.$type.'" desconhecido.');
    }

    $method = new \ReflectionMethod(get_class($service), $method);
    $method->invokeArgs($service, $transition);
};

$addTransitions = function($service, array $transitions, $type) use ($addTransition) {
    foreach ($transitions as $transition) {
        $addTransition($service, $transition, $type);
    }
};

$createService = function ($serviceFilePath) use ($serviceTitle, $addInputs, $addConfigs, $addProportional, $addTransitions) {

    $parser = new \Symfony\Component\Yaml\Parser();
    $data = $parser->parse(file_get_contents($serviceFilePath));

    $serviceTitle($data['serviceName']);

    $service = new \Implementation\Service\Pricing\ServicePricing($data['serviceName']);

    if (isset($data['resources'])) {
        foreach ($data['resources'] as $item) {
            $resource = include __DIR__.'/../resource/'.$item['type'].'/'.$item['alias'].'/'.$item['alias'].'.php';
            $service->addResource($resource);
        }
    }

    if (isset($data['configurations'])) {
        $addConfigs($service, $data['configurations']);
    }

    if (isset($data['proportional'])) {
        $addProportional($service, $data['proportional']);
    }

    if (isset($data['inputs'])) {
        $addInputs($service, $data['inputs']);
    }

    if (isset($data['transitions'])) {
        $transitions = $data['transitions'];

        if (isset($transitions['fromConfig'])) {
            $addTransitions($service, $transitions['fromConfig'], 'fromConfig');
        }
        if (isset($transitions['fromInput'])) {
            $addTransitions($service, $transitions['fromInput'], 'fromInput');
        }
        if (isset($transitions['fromResource'])) {
            $addTransitions($service, $transitions['fromResource'], 'fromResource');
        }
    }


    return $service;
};



$serviceStart = function($filePath) use ($createService) {
    $serviceAlias = rtrim(end(explode('/', $filePath)), '.php');
    $dir = dirname($filePath);
    return $createService($dir . '/' .$serviceAlias.'.yml');
};

$serviceEnd = function(\Implementation\Service\Pricing\ServicePricing $service, $argv) use ($consoleInteraction) {
    $service->process();
    $consoleInteraction($service, $argv);
};

<?php
use Implementation\Service\Pricing\Parameter\ParameterFactory;

$addInputs = function(\Service\Pricing\Parameterizable $object, array $inputs) {
    foreach ($inputs as $input) {
        $inputParameter = ParameterFactory::createInput(
            $input['name'],
            $input['code'],
            $input['type'],
            $input['formatter']
        );
        $object->addInputParameter($inputParameter);
    }
};

$addConfigs = function(\Service\Pricing\Parameterizable $object, array $configs) {
    foreach ($configs as $config) {
        $configParameter = ParameterFactory::createConfiguration(
            $config['name'],
            $config['code'],
            $config['type'],
            $config['value'],
            $config['formatter']
        );
        $object->addConfiguration($configParameter);
    }
};

$addProportional = function(\Service\Pricing\Proportionable $object, array $proportional) {
    $proportionalParameter = ParameterFactory::createProportional(
        $proportional['name'],
        $proportional['code'],
        $proportional['type'],
        $proportional['signal'],
        $proportional['formatter']
    );
    $object->setProportionalParameter($proportionalParameter);
};

$addInputValues = function(\Service\Pricing\Parameterizable $object, array $values) {
    foreach ($values as $value) {
        $object->input($value['code'], $value['value']);
    }
};
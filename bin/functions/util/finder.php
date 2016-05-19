<?php
$findInputParameter = function(\Service\Pricing\Parameterizable $object, $code) {
    $it = $object->getInputParameters()->getIterator();
    $it->rewind();
    /**
     * @var \Implementation\Service\Pricing\Parameter\InputParameter $parameter
     */
    $foundInputParameter = null;
    while($it->valid()) {
        $parameter = $it->current();
        if ($parameter->getCode() == $code) {
            $foundInputParameter = $parameter;
        }
        $it->next();
    }
    return $foundInputParameter;
};

$findConfiguration = function(\Service\Pricing\Parameterizable $object, $code) {
    $it = $object->getConfigurations()->getIterator();
    $it->rewind();

    /**
     * @var \Implementation\Service\Pricing\Parameter\Configuration $config
     */
    $foundConfig = null;
    while($it->valid()) {
        $config = $it->current();
        if ($config->getCode() == $code) {
            $foundConfig = $config;
        }
        $it->next();
    }
    return $foundConfig;
};

$findKey = function(\Service\Pricing\ServiceResource\ServiceResource $resource, $code) {
    $it = $resource->getKeys()->getIterator();
    $it->rewind();

    /**
     * @var \Implementation\Service\Pricing\Parameter\Key $key
     */
    $foundKey = null;
    while($it->valid()) {
        $key = $it->current();
        if ($key->getCode() == $code) {
            $foundKey = $key;
        }
        $it->next();
    }
    return $foundKey;
};

$findParameter = function (\Service\Pricing\Parameterizable $object, $code = null) use (
    $findInputParameter,
    $findConfiguration,
    $findKey
) {
    if (!$code) {
        return null;
    }

    $exp = explode('-', $code);

    switch (true) {
        case ($exp[0] == 'input'):
            return $findInputParameter($object, $code);
        case ($exp[0] == 'config'):
            return $findConfiguration($object, $code);
        case ($exp[0] == 'key'):
            if (!$object instanceof \Service\Pricing\ServiceResource\ServiceResource) {
                throw new \Exception('Impossivel encontrar keys em objecto diferente de ServiceResource.');
            }
            return $findKey($object, $code);
        case ($exp[0] == 'prop'):
            /**
             * @var \Service\Pricing\ServiceResource\ServiceFinancialResource $object
             */
            return $object->getProportionalParameter();
        default:
            throw new \Exception('Code sem prefixo reconhecido em "'.$code.'": input-, config- ou key-');
    }
};
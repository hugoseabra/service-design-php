<?php
$output = function ($message, $preBreak = true, $postBreak = true) {
    if ($preBreak) { echo PHP_EOL; }
    echo $message;
    if ($postBreak) { echo PHP_EOL; }
};

$serviceTitle = function($title) use ($output) {
    $output(shell_exec('figlet '.strtoupper($title)), true, false);
};

$resourceTitle = function($title) use ($output) {
    $output('#####################################################################', true, false);
    $output (strtoupper($title).':');
    $output('#####################################################################', false, true);
};

$title = function($title) use ($output) {
    $output('=====================================================================', true, false);
    $output (strtoupper($title).':');
    $output('---------------------------------------------------------------------', false, true);
};

$subtitle = function ($title) use ($output) {
    $output($title.':', false);
    $output('----------------------------------', false);
};

$subsection = function($title = null) use ($output, $subtitle) {
    $output('---------------------------------------------------------------------');
    if ($title) {
        $subtitle($title);
    }
};

$end = function ($preBreak = true, $postBreak = true) use ($output) {
    $output('=====================================================================', $preBreak, $postBreak);
};

$output_object = function ($object) use ($output, $subsection) {
    var_export($object);
};

$output_parameter = function (\Service\Pricing\Parameter $object) use ($output, $subsection, $end) {
    $value = $object->getMaskedValue() ?: $object->getStrictType()->getValue();
    $output(' - '.$object->getName().': '. $value, false);
};

$output_parameters = function (\Util\Collection $collection) use ($output_parameter) {
    $it = $collection->getIterator();
    $it->rewind();
    while($it->valid()) {
        $output_parameter($it->current());
        $it->next();
    }
};

$output_config = function (\Service\Pricing\Parameter $object) use ($output, $subsection, $end) {
    $value = $object->getMaskedValue() ?: $object->getStrictType()->getValue();
    $output(' - '.$object->getName().': '. $value, false);
};

$output_key = function (\Service\Pricing\Indicator $object) use ($output, $subsection, $end) {
    $value = $object->getMaskedValue() ?: $object->getValue();
    $output(' - '.$object->getName().': '. $value, false);
};

$output_result = function (\Service\Pricing\ServiceResource\ServiceFinancialResource $object) use ($output, $subsection, $end) {
    $result = $object->getResult();
    $key = $result->getKey();
    $value = $key->getMaskedValue() ?: $key->getValue();
    $output(' - '.$key->getName().': '. $value, false);

    $proportionalKey = $result->getProportionalKey();
    $value = $proportionalKey->getMaskedValue() ?: $proportionalKey->getValue();
    $output(' - '.$proportionalKey->getName().': '. $value, false);
};
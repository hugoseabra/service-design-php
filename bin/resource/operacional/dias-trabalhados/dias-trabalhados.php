<?php
include_once __DIR__.'/../../../functions/resource.php';

$name = 'DIAS TRABALHADOS';
$fileName = 'dias-trabalhados';

return $createOperationalResource($name, $fileName, __DIR__ . '/'.$fileName.'.yml');

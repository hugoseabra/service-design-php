<?php
include_once __DIR__.'/../../../functions/resource.php';

$name = 'DIAS TRABALHADOS - ASTEC';
$fileName = 'dias-trabalhados-astec';

return $createOperationalResource($name, $fileName, __DIR__ . '/'.$fileName.'.yml');

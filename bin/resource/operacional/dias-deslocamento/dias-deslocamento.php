<?php
include_once __DIR__.'/../../../functions/resource.php';

$name = 'DIAS DE DESLOCAMENTO';
$fileName = 'dias-deslocamento';

return $createOperationalResource($name, $fileName, __DIR__ . '/'.$fileName.'.yml');

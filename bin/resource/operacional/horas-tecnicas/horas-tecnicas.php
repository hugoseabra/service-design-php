<?php
include_once __DIR__.'/../../../functions/resource.php';

$name = 'HORAS TÉCNICAS';
$fileName = 'horas-tecnicas';

return $createOperationalResource($name, $fileName, __DIR__ . '/'.$fileName.'.yml');

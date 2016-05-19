<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CALIBRAGEM DE COLHADORAS';
$fileName = 'calibragem-colhedora';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

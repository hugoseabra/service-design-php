<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CONFECÇÃO DE MAPAS';
$fileName = 'confeccao-mapas';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

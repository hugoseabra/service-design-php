<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CUSTO DE TÉCNICOS - PRODUTIVIDADE';
$fileName = 'custo-tecnicos-produtividade';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

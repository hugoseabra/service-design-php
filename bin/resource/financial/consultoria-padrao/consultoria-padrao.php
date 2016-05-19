<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CONSULTORIA PADRÃO';
$fileName = 'consultoria-padrao';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

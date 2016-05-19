<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CUSTO FIXO';
$fileName = 'custo-fixo';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

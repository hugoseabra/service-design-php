<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'DESLOCAMENTO PADRÃO COM LIMITE';
$fileName = 'deslocamento-limite';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

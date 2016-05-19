<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'CONFECÇÃO DE PROJETOS DE CUSTEIO AGRÍCOLA';
$fileName = 'confeccao-projeto-custeio-agricola';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

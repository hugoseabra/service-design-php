<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'HOSPEDAGEM E ALIMENTAÇÃO';
$fileName = 'hospedagem-alimentacao';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

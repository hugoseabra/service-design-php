<?php
include_once __DIR__ . '/../../../functions/resource.php';

$name = 'KNOW-HOW';
$fileName = 'know-how';

return $createFinancialResource($name, $fileName, __DIR__ . '/' .$fileName.'.yml');

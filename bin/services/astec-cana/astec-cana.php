<?php
define('OUTPUT_ECHO', true);

include_once __DIR__ . '/../../../autoload.php';
include_once __DIR__ . '/../../functions/report.php';
include_once __DIR__ . '/../../functions/service.php';

$service = $serviceStart(__FILE__);

#=================================================================================================================
# ENTRADA DE VALORES
#-----------------------------------------------------------------------------------------------------------------
$service->inputProportionalValue(500.00);
$service->input('input-custo-fixo-total', 960000.00);
$service->input('input-qdade-trabalhos-realizados', 133334);
$service->input('input-horas-trabalhadas-dia', 8.00);
$service->input('input-distancia', 350.00);
$service->input('input-qdade-projetos', 4);
$service->input('input-preco-consultoria', 18.00);
$service->input('input-qdade-trabalhadores', 2);
$service->input('input-num-visitas', 2);

#=================================================================================================================
$serviceEnd($service, $argv);
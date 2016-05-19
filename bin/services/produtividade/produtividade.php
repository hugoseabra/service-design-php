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
$service->input('input-qdade-trabalhadores', 2);
$service->input('input-horas-trabalhadas-dia', 8.00);
$service->input('input-qdade-visitas', 7);
$service->input('input-distancia', 350.00);
$service->input('input-qdade-colhedoras', 4);
$service->input('input-horas-tecnico', 8);
$service->input('input-horas-tecnico-senior', 4);
$service->input('input-custo-tecnico-hora', 18.00);
$service->input('input-custo-tecnico-senior-hora', 63.50);

#=================================================================================================================
$serviceEnd($service, $argv);
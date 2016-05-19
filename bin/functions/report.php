<?php
include_once __DIR__.'/util/template.php';

$createTable = function(array $headers, array $rows) {
    $table = new \Symfony\Component\Console\Helper\Table(new \Symfony\Component\Console\Output\ConsoleOutput());
    $table->setHeaders($headers);
    $table->setRows($rows);

    return $table;
};

$showResourceReport = function(\Service\Pricing\ServiceResource\ServiceResource $resource) use (
    $resourceTitle,
    $title,
    $end,
    $output_config,
    $output_parameter,
    $output_key,
    $output_result
) {
    $resourceTitle($resource->getName());

    $title('Configurations');
    foreach ($resource->getConfigurations() as $config) {
        $output_config($config);
    }

    $financial = $resource instanceof \Service\Pricing\ServiceResource\ServiceFinancialResource;
    if ($financial) {
        /**
         * @var \Service\Pricing\ServiceResource\ServiceFinancialResource $resource
         */
        $title('Proportional');
        $output_parameter($resource->getProportionalParameter());
    }

    $title('Input Parameters');
    foreach ($resource->getInputParameters() as $parameter) {
        $output_parameter($parameter);
    }

    $title('Keys');
    $num = $resource->getKeys()->count();
    $counter = 1;
    foreach ($resource->getKeys() as $key) {

        if (!$financial && ($counter == $num)) {
            continue;
        }

        $output_key($key);
        $counter++;
    }

    $title('Resultado');
    if (!$financial) {
        $last = end($resource->getKeys()->getIterator()->getArrayCopy());
        $output_key($last);
    } else {
        $output_result($resource);
    }
    $end(false);
};

$showInputs = function(\Service\Pricing\Parameterizable $object) use ($title, $createTable) {
    $it = $object->getInputParameters()->getIterator();
    $it->rewind();

    $values = [];

    if ($object instanceof \Service\Pricing\Proportionable) {
        $proportional = $object->getProportionalParameter();
        $values[] = ['- '.$proportional->getName(), $proportional->getMaskedValue()];
    }

    /**
     * @var \Implementation\Service\Pricing\Parameter\InputParameter $input
     */
    while($it->valid()) {
        $input = $it->current();
        $values[] = ['- '.$input->getName(), $input->getMaskedValue()];
        $it->next();
    }

    $title('PARAMETROS DE ENTRADA');
    $table = $createTable(['Parâmetro', 'Valor'], $values);
    $table->render();
};

$showResourceResult = function(\Service\Pricing\ServicePricing $service) use ($title, $subsection, $createTable) {

    $resources = $service->getResources();

    $it = $resources->getIterator();
    $it->rewind();

    $inputValues = [];
    $operationalRows = [];
    $financialRows = [];

    $sigla = null;

    $custosTotais = [];
    $custosProporcionais = [];

    while($it->valid()) {
        $resource = $it->current();

        if (!$resource instanceof \Service\Pricing\ServiceResource\ServiceFinancialResource) {

            /**
             * @var \Service\Pricing\ServiceResource\ServiceResource $resource
             */
            $operationalRows[] = [
                '- '.$resource->getName(),
                $resource->getResult()->getMaskedValue()
            ];

            $it->next();
            continue;
        }

        $custo = $resource->getResult()->getKey()->getValue();
        $custoProporcional = $resource->getResult()->getProportionalKey()->getValue();

        $custosTotais[] = $custo;
        $custosProporcionais[] = $custoProporcional;

        /**
         * @var \Service\Pricing\ServiceResource\ServiceFinancialResource $resource
         */
        $financialRows[] = [
            '- '.$resource->getName(),
            $resource->getResult()->getKey()->getMaskedValue(),
            $resource->getResult()->getProportionalKey()->getMaskedValue()
        ];

        $sigla = $resource->getProportionalParameter()->getSignal();

        $it->next();
    }

    $totais = [
        'TOTAIS',
        'R$ '. number_format(array_sum($custosTotais), 2, ',', '.'),
        'R$ '. number_format(array_sum($custosProporcionais), 2, ',', '.'),
    ];

    $title('CUSTOS DE RECURSOS');

    echo PHP_EOL;
    echo "Recursos Operacionais:";
    echo PHP_EOL;
    $operationalTable = $createTable(['Serviço', 'Resultado'], $operationalRows);
    $operationalTable->render();

    $subsection();

    echo PHP_EOL;
    echo "Recursos Financeiros:";
    echo PHP_EOL;
    $financialTable = $createTable(['Serviço', 'Custo Total', 'Custo por '.$sigla], array_merge($financialRows, [$totais]));
    $financialTable->render();
};

$showResourcesFromService = function(\Service\Pricing\ServicePricing $service) {
    $it = $service->getResources()->getIterator();
    $it->rewind();
    echo PHP_EOL;
    /**
     * @var \Service\Pricing\ServiceResource\ServiceResource $resource
     */
    while($it->valid()) {
        $resource = $it->current();
        echo ' - '. $resource->getCode();
        echo PHP_EOL;
        $it->next();
    }
    echo PHP_EOL;
};

$showServiceReport = function(\Service\Pricing\ServicePricing $service) use ($showResourceResult, $showInputs, $title, $end) {

    $showInputs($service);
    $showResourceResult($service);
    $end();
};

$consoleInteraction = function(\Implementation\Service\Pricing\ServicePricing $service, array $argv) use (
    $showServiceReport,
    $showResourcesFromService,
    $showResourceReport,
    $output,
    $subsection
) {
    if (count($argv) == 1) {
        $showServiceReport($service);
    } else {

        $exp = explode('=', $argv[1]);

        if ($exp[0] == trim('--options')) {
            echo PHP_EOL;
            echo "Options:";
            echo PHP_EOL;
            echo " --recs - visualizar recursos disponíveis.";
            echo PHP_EOL;
            echo " --rec=<nome_do_recurso> - visualizar detalhes do recurso.";
            echo PHP_EOL;
            echo " --inputs - visualizar os aliases de inputs de entrada do serviço.";
            echo PHP_EOL;
            echo PHP_EOL;
        }

        if ($exp[0] == str_replace(' ', '', trim('--recs'))) {
            echo PHP_EOL;
            echo "Recursos Disponíveis:";
            $showResourcesFromService($service);
        }
        if ($exp[0] == trim('--rec')) {
            $alias = trim($exp[1]);

            $resource = $service->getResources()->get($alias);

            if(!$resource) {
                echo PHP_EOL;
                echo 'Nenhum recurso com nome "'.$alias.'"';
                echo PHP_EOL;
                echo PHP_EOL;
            } else {
                $showResourceReport($resource);
                echo PHP_EOL;
            }
        }

        if ($exp[0] == trim('--inputs')) {

            $proportional = $service->getProportionalParameter();
            $value = $proportional->getMaskedValue() ?: $proportional->getStrictType()->getValue();
            $output(' - '.$proportional->getCode().': '. $value, false);

            $subsection();

            $it = $service->getInputParameters()->getIterator();
            $it->rewind();

            /**
             * @var \Implementation\Service\Pricing\Parameter\InputParameter $input
             */
            while($it->valid()) {
                $input = $it->current();

                $value = $input->getMaskedValue() ?: $input->getStrictType()->getValue();
                $output(' - '.$input->getCode().': '. $value, false);

                $it->next();
            }
            echo PHP_EOL;
            echo PHP_EOL;
        }
    }
};
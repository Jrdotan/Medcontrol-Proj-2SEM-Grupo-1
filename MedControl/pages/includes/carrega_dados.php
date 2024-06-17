<?php
session_start();
header('Content-Type: text/javascript; charset=UTF-8');

include('../classes/db_classes.php');
include('../classes/data_grafico.php');
$dataClass = new DataGraphic();
$id_doenca = $_SESSION['filterCid'];

// ===========================================================================
// Carregador de dados para o grafico de mapa
// ===========================================================================

# Casos: Confirmado
$MapaChartConf = $dataClass->MapaGeoChart("confirmado", $id_doenca);
# Casos: Suspeito
$MapaChartSusp = $dataClass->MapaGeoChart("suspeito", $id_doenca);
# Casos: Ambos os casos que foram a óbito
$MapaChartAll = $dataClass->MapaGeoChart("todos", $id_doenca, 1);

# Codifica os dados para JSON
$jsonDataConf = json_encode($MapaChartConf);
$jsonDataSusp = json_encode($MapaChartSusp);
$jsonDataAll = json_encode($MapaChartAll);

// Verificar se a codificação JSON foi bem-sucedida
if ($jsonDataConf === false || $jsonDataSusp === false || $jsonDataAll === false) {
    $jsonData = json_encode(array('error' => 'Failed to encode data', 'errorMessage' => json_last_error_msg()));
}

// Saída do JSON
echo 'var jsonDataMapaChartConf = ' . $jsonDataConf . ';';
echo 'var jsonDataMapaChartSusp = ' . $jsonDataSusp . ';';
echo 'var jsonDataMapaChartAll = ' . $jsonDataAll . ';';

// ===========================================================================
// Carregador de dados para o grafico de colunas
// ===========================================================================

# Casos: Confirmado
$XChartConf = $dataClass->GraficoXChart("confirmado", $id_doenca);
# Casos: Suspeito
$XChartSusp = $dataClass->GraficoXChart("suspeito", $id_doenca);
# Casos: Ambos os casos que foram a óbito
$XChartAll = $dataClass->GraficoXChart("todos", $id_doenca, 1);

# Codifica os dados para JSON
$jsonDataConf = json_encode($XChartConf);
$jsonDataSusp = json_encode($XChartSusp);
$jsonDataAll = json_encode($XChartAll);

// Verificar se a codificação JSON foi bem-sucedida
if ($jsonDataConf === false || $jsonDataSusp === false || $jsonDataAll === false) {
    $jsonData = json_encode(array('error' => 'Failed to encode data', 'errorMessage' => json_last_error_msg()));
}

// Saída do JSON
echo 'var jsonDataXChartConf = ' . $jsonDataConf . ';';
echo 'var jsonDataXChartSusp = ' . $jsonDataSusp . ';';
echo 'var jsonDataXChartAll = ' . $jsonDataAll . ';';

// ===========================================================================
// Carregador de dados para o grafico de linhas
// ===========================================================================

# Casos: Confirmado
$LinhaChartConf = $dataClass->GraficoLinhaChart("confirmado", $id_doenca);
# Casos: Suspeito
$LinhaChartSusp = $dataClass->GraficoLinhaChart("suspeito", $id_doenca);
# Casos: Ambos os casos que foram a óbito
$LinhaChartAll = $dataClass->GraficoLinhaChart("todos", $id_doenca, 1);

# Codifica os dados para JSON
$jsonDataConf = json_encode($LinhaChartConf);
$jsonDataSusp = json_encode($LinhaChartSusp);
$jsonDataAll = json_encode($LinhaChartAll);

// Verificar se a codificação JSON foi bem-sucedida
if ($jsonDataConf === false || $jsonDataSusp === false || $jsonDataAll === false) {
    $jsonData = json_encode(array('error' => 'Failed to encode data', 'errorMessage' => json_last_error_msg()));
}

// Saída do JSON
echo 'var jsonDataLinhaChartConf = ' . $jsonDataConf . ';';
echo 'var jsonDataLinhaChartSusp = ' . $jsonDataSusp . ';';
echo 'var jsonDataLinhaChartAll = ' . $jsonDataAll . ';';


?>

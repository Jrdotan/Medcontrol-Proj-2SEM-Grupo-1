<?php
session_start();
require_once('auth.php');
require './classes/db_classes.php';
require './classes/Validador_registro_paciente.php';
require './classes/Gestor_registro_paciente.php';

try {
    $database = new medcontrol_db();
    $dbh = $database->connect();
} catch (PDOException $e) {
    header("location:index.php");
    echo "Erro de conexão: " . $e->getMessage();
}

$cpf = filter_input(INPUT_GET, 'cpf');

if($cpf){
    $comandosql = $dbh->prepare("DELETE FROM paciente WHERE CPF = :cpf");
    $comandosql->bindValue(":cpf", $cpf);
    $comandosql->execute();
}

header("Location: ler_pacientes.php?error=none");
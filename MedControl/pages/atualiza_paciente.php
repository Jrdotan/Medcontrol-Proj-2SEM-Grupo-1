<?php

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

if(!$dbh){ //verifica se conexão existe
    header("location: editar_pacientes.php?error=conexaofalha");
    exit();
}

$cpf = filter_input(INPUT_POST, 'cpf');
$nome = filter_input(INPUT_POST, 'nome_completo');
$idade = filter_input(INPUT_POST, 'idade');
$telefone = filter_input(INPUT_POST, 'telefone');
$cidade = filter_input(INPUT_POST, 'cidade');
$estado = filter_input(INPUT_POST, 'estado');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($cpf && $nome && $idade && $telefone && $cidade && $estado && $email){
    $sql = $dbh->prepare("UPDATE paciente SET nome_completo = :nome_completo, idade = :idade, telefone = :telefone, cidade = :cidade, estado = :estado, email = :email WHERE CPF = :cpf");
    $sql->bindValue(":cpf", $cpf);
    $sql->bindValue(":nome_completo", $nome);
    $sql->bindValue(":idade", $idade);
    $sql->bindValue(":telefone", $telefone);
    $sql->bindValue(":cidade", $cidade);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":email", $email);

    $sql->execute();

    header("location: ler_pacientes.php");
    exit();
}

if(!$cpf || !$nome || !$idade || !$telefone || !$cidade || !$estado || !$email){ // Verificar se algum dos campos está vazio
    header("location: editar_pacientes.php?error=edicaofalhoufaltacampos");
    exit();
}

?>
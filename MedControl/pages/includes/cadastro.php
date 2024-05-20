<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nomeCompleto= $_POST["nomeCompleto"];
    $password = $_POST["password"];
    $senhaRepetida = $_POST["senhaRepetida"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $idade = $_POST["idade"];
    $cargo = $_POST["cargo"];
    $cpf = $_POST["cpf"];
    $crm = $_POST["crm"];

    include "../classes/db_classes.php";
    include "../classes/Validador_cadastro_funcionario.php";
    include "../classes/Gestor_cadastro_funcionario.php";

    $cadastro = new funcionario($nomeCompleto, $password, $senhaRepetida, $email, $sexo, $idade, $cargo, $cpf, $crm);

//lidar com problemas e erros no cadastro
    $cadastro->validar_cadastro_funcionario();

    header("location: ../../index.php");
}

else{
    header("location: ../../index.php");
}



?>


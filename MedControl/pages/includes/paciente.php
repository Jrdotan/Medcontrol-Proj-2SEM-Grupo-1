<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nomePaciente = $_POST["nomePaciente"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $cidade = $_POST["cidade"];
    $idade = $_POST["idade"];
    $estado = $_POST["estado"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];

    include "../classes/db_classes.php";
    include "../classes/Validador_registro_paciente.php";
    include "../classes/Gestor_registro_paciente.php";

    $registro = new controle_paciente($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone);

//lidar com problemas e erros no cadastro
    $registro->validar_registro_paciente();

    header("Location: ../ler_pacientes.php?error=none");
}

else{
    header("location: ../ler_pacientes.php?error=cadastropacientefalhou");
}



?>

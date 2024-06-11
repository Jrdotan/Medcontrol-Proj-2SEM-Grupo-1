<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    include "../classes/db_classes.php";
    include "../classes/Validador_login_funcionario.php";
    include "../classes/Gestor_login_funcionario.php";

    $logar = new controle_login($email, $password);

    // Lidar com problemas e erros no cadastro
    $login_status = $logar->validar_login_funcionario();

    if ($login_status == true) { 
        header("location: ../home_pacientes.php");
    } else {
        
        header("location: ../login.php?error=loginfalhou"); 
    }

}

?>



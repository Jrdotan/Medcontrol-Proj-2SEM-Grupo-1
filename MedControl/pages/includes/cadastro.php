<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username= $_POST["username"];
    $password = $_POST["password"];
    $password_rpt = $_POST["password_rpt"];
    $email = $_POST["email"];
    
    include "../classes/db_classes.php";
    include "../classes/classe_cadastro.php";
    include "../classes/classe_cadastro2.php";

    $cadastro = new funcionario($username, $password, $password_rpt, $email);

//lidar com problemas e erros no cadastro
    $cadastro->validar_cadastro_funcionario();

    header("location: index.php");
}

else{
    header("location: index.php");
}



?>


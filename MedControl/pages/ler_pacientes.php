<?php
session_start();
require_once('./classes/db_classes.php');
require_once('./classes/Validador_registro_paciente.php');
require_once('./classes/Gestor_registro_paciente.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pacientes Cadastrados</title>
</head>
<body>
    <center>
        <h2>Pacientes Cadastrados</h2>
    </center>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>idade</th>
            <th>sexo</th>
            <th>cidade</th>
            <th>estado</th>
            <th>CPF</th>
            <th>email</th>
            <th>telefone</th>
        </tr>
        <?php
        $cadastro = new controle_paciente($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone);
        $cadastro->ler_pacientes();
        ?>
    </table>

    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>
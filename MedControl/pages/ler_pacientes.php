<?php

require('./classes/db_classes.php');

try {
    $database = new medcontrol_db();
    $dbh = $database->connect();
    echo "Bem vindo a tela de edição!";
} catch (PDOException $e) {
    header("location:index.php");
    echo "Erro de conexão: " . $e->getMessage();
}

// Verificar se a conexão foi bem sucedida
if(!$dbh) {
    echo "Erro ao conectar ao banco de dados.";
    exit();
}

// Consulta SQL para obter os pacientes cadastrados
$sql = "SELECT ID, nome_completo, idade, sexo, cidade, estado, CPF, email, telefone FROM paciente";

// Executar a consulta
$result = $dbh->query($sql);

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
            <th>Idade</th>
            <th>Sexo</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Métodos</th>
        </tr>
        <?php
        // Verificar se a consulta retornou resultados
        if($result && $result->rowCount() > 0) {
            // Loop através dos resultados e exibir cada paciente em uma linha da tabela
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "
                <tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['nome_completo']}</td>
                    <td>{$row['idade']}</td>
                    <td>{$row['sexo']}</td>
                    <td>{$row['cidade']}</td>
                    <td>{$row['estado']}</td>
                    <td>{$row['CPF']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['telefone']}</td>
                    <td>
                        <a href='editar_pacientes.php?cpf=" . htmlspecialchars($row['CPF']) . "'>editar</a>
                        <a href='deletar_pacientes.php?cpf=" . htmlspecialchars($row['CPF']) . "'>deletar</a>
                    </td>
                </tr>
                ";
            }
        } else {
            // Se não houver pacientes cadastrados, exibir uma mensagem
            echo "<tr><td colspan='10'>Nenhum paciente cadastrado.</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="../index.php">Voltar</a>
</body>
</html>
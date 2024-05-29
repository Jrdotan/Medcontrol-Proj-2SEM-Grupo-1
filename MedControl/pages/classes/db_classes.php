<?php

class medcontrol_db
{

    public function connect()
    {
        try {
            // Variaveis ambientes
            $username = "root";
            $password = "Ped#152319";
            $dbh = new PDO('mysql:host=localhost;dbname=mdcontrol_db', $username, $password);
        } catch (PDOException $e) {
            // Registra log de erro
            error_log("Erro de conexão: " . $e->getMessage(), 0);
            // Avisa o usuário caso um erro de conexão ocorra
            echo "Um erro ocorreu ao tentar acessar o banco";
            exit();
        }

        return $dbh;
    }
}

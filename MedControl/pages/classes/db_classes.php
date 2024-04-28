<?php

class medcontrol_db {

    protected function connect() {
        try {
            // Variaveis ambientes
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=medcontrol_db', $username, $password);
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
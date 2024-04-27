<?php

class cadastro_funcionario extends medcontrol_db{

    protected function set_usuario($username, $password, $email) // Método que insere dados de um cadastro no banco
    {
        $comandosql = $this->connect()->prepare('INSERT INTO usuario (username, pwd, email) VALUES (?, ?, ?);');
        
        $cripto_senha = password_hash($password, PASSWORD_DEFAULT);
           
        if(!$comandosql->execute(array($username, $cripto_senha, $email))){
           $comandosql = null;
           header("location: ../index.php?error=comandosqlfalhou");
           exit();
        }
        $checar_resultado;
   
        if($comandosql->rowCount() > 0){
           $checar_resultado = false;
   
        }
        else{
           $checar_resultado = true;
        }
   
        return $checar_resultado;
       }


    protected function checar_usuario($username, $email) // Método que checa se dados de funcionário existem no banco
    {
     $comandosql = $this->connect()->prepare('SELECT username FROM usuario WHERE username = ? OR email = ?;'); 
        
     if(!$comandosql->execute(array($username,$email))){
        $comandosql = null;
        header("location: ../index.php?error=comandosqlfalhou");
        exit();
     }
     $checar_resultado;

     if($comandosql->rowCount() > 0){
        $checar_resultado = false;

     }
     else{
        $checar_resultado = true;
     }

     return $checar_resultado;
    }
}



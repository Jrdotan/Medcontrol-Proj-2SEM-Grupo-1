<?php

class cadastro_funcionario extends medcontrol_db{

    protected function set_usuario($username, $password, $email) // Método que insere dados de um cadastro no banco
    {
        $comandosql = $this->connect()->prepare('INSERT INTO usuario (username, pwd, email) VALUES (?, ?, ?);');
        
        $cripto_senha = password_hash($password, PASSWORD_DEFAULT); //Criptografa senha inserida
           
        if(!$comandosql->execute(array($username, $cripto_senha, $email))) //executa instruções
        {
           $comandosql = null;
           header("location: ../cadastre.php?error=comandosqlfalhou");
           exit();
        }
        $checar_resultado;
   
        if($comandosql->rowCount() > 0) //verifica se inserção funcionou
        
        {
         $checar_resultado = false;
         header("location: ../cadastre.php?error=comandosqlfalhou");
         return $checar_resultado;
   
        }
        else{
           $checar_resultado = true;
           header("location: ../../cadastre.php?error=comandosqlfalhou");
           return $checar_resultado;
        }
   
        
       }


    protected function checar_usuario($username, $email) // Método que checa se dados de funcionário existem no banco
    {
     $comandosql = $this->connect()->prepare('SELECT username FROM usuario WHERE username = ? OR email = ?;'); 
        
     if(!$comandosql->execute(array($username,$email))){
        $comandosql = null;
        header("location: ../cadastre.php?error=comandosqlfalhou");
        exit();
     }
     $checar_resultado;

     if($comandosql->rowCount() > 0) //verifica se inserção funcionou
     {

        $checar_resultado = false;
        header("location: ../cadastre.php?error=comandosqlfalhou");
        return $checar_resultado;

     }
     else{
        $checar_resultado = true;
        header("location: ../cadastre.php?error=comandosqlfalhou");
        return $checar_resultado;
     }

     
    }
}



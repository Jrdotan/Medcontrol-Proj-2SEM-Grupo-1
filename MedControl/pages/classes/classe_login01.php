<?php

class login_funcionario extends medcontrol_db{

    protected function get_usuario($username, $password){
        $comandosql = $this->connect()->prepare('SELECT pwd from usuario WHERE username = ? OR email = ?;');
        
        
           
        if(!$comandosql->execute(array($username, $password))){
           $comandosql = null;
           header("location: ../index.php?error=comandosqlfalhou");
           exit();
        }
   
        if($comandosql->rowCount() == 0){
           $comandosql = null;
           header("location: ../index.php?error=usuarionaoencontrado");
           exit();
        }

        $cripto_senha = $comandosql->fetchAll(PDO::FETCH_ASSOC);
        
        $checar_senha = password_verify($password, $cripto_senha[0]["pwd"]);
         
        
   
       

      if($checar_senha == false){
        $comandosql = null;
        header("location: ../index.php?error=usuarionaoencontrado");
        exit();
     }

        elseif($checar_senha == true){
            $comandosql = $this->connect()->prepare('SELECT * from usuario WHERE username = ? OR email = ? AND pwd = ?;');
            
            if(!$comandosql->execute(array($username, $username, $password))){
                $comandosql = null;
                header("location: ../index.php?error=comandosqlfalhou");
                exit();
             }

             if($comandosql->Count() == 0){
                $comandosql = null;
                header("location: ../index.php?error=usuarionaoencontrado");
                exit();
             }

             $usuario = $comandosql->fetchALL(PDO::FETCH_ASSOC);

             session_start();
             $_SESSION["user_id"] = $usuario[0]["id"];
             $_SESSION["user_username"] = $usuario[0]["username"];
             
             $comandosql = null;
        }

     $comandosql = null;

}
}
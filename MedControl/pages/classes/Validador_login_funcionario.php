<?php
class login_funcionario extends medcontrol_db{

    protected function get_usuario($email, $password){
        $comandosql = $this->connect()->prepare('SELECT senha from funcionario WHERE email = ?;');
        
        
           
        if(!$comandosql->execute(array($email))){
           $comandosql = null;
           header("location: ../login.php?error=comandosqlfalhou");
           exit();
        }
   
        if(!$comandosql->rowCount() > 0){
           $comandosql = null;
           header("location: ../login.php?error=usuarionaoencontrado");
           exit();
        }

        $cripto_senha = $comandosql->fetchAll(PDO::FETCH_ASSOC);
        
        $checar_senha = password_verify($password, $cripto_senha[0]["senha"]);
         
        
   
       

      if($checar_senha == false){
        $comandosql = null;
        header("location: ../login.php?error=senhanaoencontrado");
        exit();
     }

        elseif($checar_senha == true){
            $comandosql = $this->connect()->prepare('SELECT * FROM funcionario WHERE email = ? AND senha = ?;');
            
            if(!$comandosql->execute(array($email,  $cripto_senha[0]["senha"]))){
                $comandosql = null;
                header("location: ../login.php?error=comandosqlfalhou");
                exit();
             }

             if(!$comandosql->rowCount() > 0){
                $comandosql = null;
                header("location: ../login.php?error=usuarionaoencontrado");
                exit();
             }
             

             $usuario = $comandosql->fetchAll(PDO::FETCH_ASSOC);
            
             session_start();
             $_SESSION["user_id"] = $usuario[0]["ID"];
             $_SESSION["user_email"] = $usuario[0]["email"];
             $_SESSION["user_crm"] = $usuario[0]["CRM"];
             $comandosql = null;
        }

     $comandosql = null;

}
}
?>
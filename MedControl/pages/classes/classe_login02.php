<?php

class controle_login extends login_funcionario{
    private $email;
    private $password;
   

    public function __construct($email, $password){
        //construtor para propriedades do objeto
        
        $this->email = $email;
        $this->password = $password;
       
    }

    public function validar_login_funcionario(){
        if($this->campo_vazio() == false){
            header("location: ../login.php?error=CampoVazio");
            exit();
        }

        else{
       
        $this->get_usuario($this->email, $this->password);
        }
        return TRUE;
        
    }

    private function campo_vazio(){
        $resultado;
        if(empty($this->email) || empty($this->password)){
            $resultado = false;

        }
        else
        {
             $resultado = true;
 
    }
    return $resultado;
}
}
?>
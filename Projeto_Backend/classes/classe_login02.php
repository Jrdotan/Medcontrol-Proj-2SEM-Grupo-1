<?php

class controle_login extends login_funcionario{
    private $username;
    private $password;
   

    public function __construct($username, $password){
        //construtor para propriedades do objeto
        
        $this->username = $username;
        $this->password = $password;
       
    }

    public function validar_login_funcionario(){
        if($this->campo_vazio() == false){
            header("location: ../index.php?error=CampoVazio");
            exit();
        }
       
        $this->set_usuario($this->username, $this->password, $this->email);
    }

    private function campo_vazio(){
        $resultado;
        if(empty($this->email) || empty($this->username)){
            $resultado = false;

        }
        else{ $resultado = true;
 
    }
    return $resultado;
}
}

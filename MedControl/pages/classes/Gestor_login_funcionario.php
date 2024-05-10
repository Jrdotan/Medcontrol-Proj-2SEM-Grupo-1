<?php

class controle_login extends login_funcionario{
    private $email;
    private $password;
   

    public function __construct($email, $password) //construtor para instâncias de login
    {   
        $this->email = $email;
        $this->password = $password;
       
    }

    public function validar_login_funcionario() //Valida login se não existirem erros
    {
        if($this->campo_vazio() == false){
            header("location: ../login.php?error=CampoVazio");
            exit();
        }

        else{
       
        $this->get_usuario($this->email, $this->password); //Pega instância de usuário no banco e realiza o login
        }
        return TRUE;
        
    }

    private function campo_vazio() //Verifica se algum dos campos do formulário está vazio
    {
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
<?php

class funcionario extends cadastro_funcionario{
    private $username;
    private $password;
    private $password_rpt;
    private $email;

    public function __construct($username, $password, $password_rpt, $email){
        //construtor para propriedades do objeto
        
        $this->username = $username;
        $this->password = $password;
        $this->password_rpt = $password_rpt;
        $this->email = $email;
    }

    public function validar_cadastro_funcionario() // Valida cadastro se nenhum erro for encontrado no formulário preenchido
    {
        if($this->campo_vazio() == false){
            header("location: index.php?error=campovazio");
            exit();
        }
        if($this->usuario_invalido() == false){
            header("location: index.php?error=usuarioinvalido");
            exit();
        }
        if($this->validar_email() == false){
            header("location: index.php?error=emailinvalido");
            exit();
        }
        if($this->validar_senha() == false){
            header("location: index.php?error=senhainvalida");
            exit();
        }
        if($this->validar_nome_usuario() == false){
            header("location: index.php?error=nomeemuso");
            exit();
        }
       

        $this->set_usuario($this->username, $this->password, $this->email);
    }

    private function campo_vazio(){
        $resultado;
        if(empty($this->email) || empty($this->username) || empty($this->password) || empty($this->password_rpt)){
            $resultado = false;

        }
        else{ $resultado = true;
 
    }
    return $resultado;
}

private function usuario_invalido(){
    $resultado;
    if(!preg_match("/^[a-zA-z0-9]*$/", $this->username)){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_senha(){
    $resultado;
    if($this->password != $this->password_rpt){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_email(){
    $resultado;
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_nome_usuario(){
    $resultado;
    if(!$this->checar_usuario($this->username, $this->email)){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}
}




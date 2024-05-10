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
            header("location: ../cadastre.php?error=campovazio");
            exit();
        }
        if($this->usuario_invalido() == false){
            header("location: ../cadastre.php?error=usuarioinvalido");
            exit();
        }
        if($this->validar_email() == false){
            header("location: ../cadastre.php?error=emailinvalido");
            exit();
        }
        if($this->validar_senha() == false){
            header("location: ../cadastre.php?error=senhainvalida");
            exit();
        }
        if($this->validar_nome_usuario() == false){
            header("location: ../cadastre.php?error=nomeemuso");
            exit();
        }
       

        $this->set_usuario($this->username, $this->password, $this->email); // Executa instruções continas na função para 
                                                                            // inserir um usuário no banco
        
    }

    private function campo_vazio() //Verifica se existe um campo vazio no formulário
    {
        $resultado;
        if(empty($this->email) || empty($this->username) || empty($this->password) || empty($this->password_rpt)){
            $resultado = false;

        }
        else{ $resultado = true;
 
    }
    return $resultado;
}

private function usuario_invalido() // Verifica se o funcionário inseriu cáracteres válidos para a construção de um usuário
{
    $resultado;
    if(!preg_match("/^[a-zA-z0-9]*$/", $this->username)) //coloca o alcance entre caracteres e numeros aceitos para usuário
    {
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_senha() // Compara senhas inseridas no campo de senha e de repetição de senha
                                 // se forem iguais, é validada.
{
    $resultado;
    if($this->password != $this->password_rpt){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_email() //valida E-Mail para cadastro no banco
{
    $resultado;
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) //insere filtro de verificação de email 
    {
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

private function validar_nome_usuario() // Checa se nome de usuário já existe no Banco
{
    $resultado;
    if(!$this->checar_usuario($this->username, $this->email)){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}
}




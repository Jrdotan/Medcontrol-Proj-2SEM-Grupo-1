<?php

class controle_paciente{
    private $nomePaciente;
    private $idade;
    private $sexo;
    private $cidade;
    private $estado;
    private $cpf;
    private $email;
    private $telefone;

    protected function __construct($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone){
        $this->nomePaciente = $nomePaciente;
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function validar_cadastro_funcionario() // Valida cadastro se nenhum erro for encontrado no formulário preenchido
    {
      
        if($this->validar_email() == false){
            header("location: ../cadastre.php?error=emailinvalido");
            exit();
        }
       
        if($this->validar_nome_paciente() == false){
            header("location: ../cadastre.php?error=nomepacienteemuso");

        }
       
       

        $this->create_paciente($this->nomeCompleto, $this->password, $this->email, $this->sexo, $this->idade, $this->cargo, $this->cpf, $this->crm); // Executa instruções continas na função para 
                                                                                                                                 // inserir um usuário no banco
        
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


    private function validar_nome_paciente() // Checa se nome de paciente já existe no Banco
{
    $resultado;
    if(!$this->checar_paciente($this->nomeCompleto, $this->email)){
        $resultado = false;

    }
    else{ $resultado = true;

}
return $resultado;
}

}
?>
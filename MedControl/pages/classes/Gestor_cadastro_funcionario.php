<?php

class funcionario extends cadastro_funcionario
{
    private $nomeCompleto;
    private $password;
    private $senhaRepetida;
    private $email;
    private $sexo;
    private $idade;
    private $cargo;
    private $cpf;
    private $crm;


    public function __construct($nomeCompleto, $password, $senhaRepetida, $email, $sexo, $idade, $cargo, $cpf, $crm)
    {
        //construtor para propriedades do objeto

        $this->nomeCompleto = $nomeCompleto;
        $this->password = $password;
        $this->senhaRepetida = $senhaRepetida;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->idade = $idade;
        $this->cargo = $cargo;
        $this->cpf = $cpf;
        $this->crm = $crm;
    }

    public function validar_cadastro_funcionario() // Valida cadastro se nenhum erro for encontrado no formulário preenchido
    {
        if ($this->campo_vazio() == false) {
            header("location: ../cadastre.php?error=campovazio");
            exit();
        }

        if ($this->validar_email() == false) {
            header("location: ../cadastre.php?error=emailinvalido");
            exit();
        }
        if ($this->validar_senha() == false) {
            header("location: ../cadastre.php?error=senhainvalida");
            exit();
        }
        if ($this->validar_nome_usuario() == false) {
            header("location: ../cadastre.php?error=nomeemuso");
            exit();
        }


        $this->set_usuario($this->nomeCompleto, $this->password, $this->email, $this->sexo, $this->idade, $this->cargo, $this->cpf, $this->crm); // Executa instruções continas na função para 
        // inserir um usuário no banco

    }

    private function campo_vazio() //Verifica se existe um campo vazio no formulário
    {
        $resultado;
        if (empty($this->email) || empty($this->nomeCompleto) || empty($this->password) || empty($this->senhaRepetida) || empty($this->sexo) || empty($this->idade) || empty($this->cargo) || empty($this->cpf)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function usuario_invalido() // Verifica se o funcionário inseriu cáracteres válidos para a construção de um usuário
    {
        $resultado;
        if (!preg_match("/^[a-zA-z0-9]*$/", $this->nomeCompleto)) //coloca o alcance entre caracteres e numeros aceitos para usuário
        {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function validar_senha() // Compara senhas inseridas no campo de senha e de repetição de senha
    // se forem iguais, é validada.
    {
        $resultado;
        if ($this->password != $this->senhaRepetida) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function validar_email() //valida E-Mail para cadastro no banco
    {
        $resultado;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) //insere filtro de verificação de email 
        {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function validar_nome_usuario() // Checa se nome de usuário já existe no Banco
    {
        $resultado;
        if (!$this->checar_usuario($this->nomeCompleto, $this->email)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }
}

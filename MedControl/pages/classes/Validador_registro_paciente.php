<?php

class registro_paciente extends medcontrol_db{

    protected function create_paciente($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone) // Método que insere dados de um cadastro no banco
    {
     
        $comandosql = $this->connect()->prepare('INSERT INTO paciente (nome_completo, idade, sexo, cidade, estado, CPF, email, telefone) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
        
        if(!$comandosql) {
         $errorMessage = implode(", ", $this->connect()->errorInfo());
         die("Erro ao preparar a declaração: " . $errorMessage);
     }
 
           
        if(!$comandosql->execute(array($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone))) //executa instruções
        {
           $comandosql = null;
           header("location: home_pacientes.php?error=comandosqlfalhouacima");
           exit();
        }
      
      
        $checar_resultado;
   
        if($comandosql->rowCount() > 0) //verifica se inserção funcionou
        
        {
         $checar_resultado = false;
         header("location: home_pacientes.php?error=comandosqlfalhou");
         return $checar_resultado;
   
        }
        else{
           $checar_resultado = true;
           header("location: home_pacientes.php?error=none");
           return $checar_resultado;
        }
   
        
       }


    protected function checar_paciente($nomePaciente, $email) // Método que checa se dados de paciente existem no banco
    {
     $comandosql = $this->connect()->prepare('SELECT nome_completo FROM paciente WHERE nome_completo = ? OR email = ?;'); 
        
     if(!$comandosql->execute(array($nomePaciente,$email))){
        $comandosql = null;
        header("location: ../home_pacientes.php?error=zxcomandosqlfalhou");
        exit();
     }
     $checar_resultado;

     if($comandosql->rowCount() > 0) //verifica se existe funcionario com esse nome
     {

        $checar_resultado = false;
        return $checar_resultado;

     }
     else{
        $checar_resultado = true;
        header("location: home_pacientes.php?error=informacaoinvalida");
        return $checar_resultado;
     }

     
    }

    

  

    }
   

?>
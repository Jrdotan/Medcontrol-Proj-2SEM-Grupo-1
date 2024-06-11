<?php
function salvar_paciente(){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nomePaciente = $_POST["nomePaciente"];
        $email = $_POST["email"];
        $sexo = $_POST["sexo"];
        $cidade = $_POST["cidade"];
        $idade = $_POST["idade"];
        $estado = $_POST["estado"];
        $cpf = $_POST["cpf"];
        $telefone = $_POST["telefone"];
        $id_paciente = $_POST['edit'];

        $pront = new PacienteQuerys;
        try {
            if ($_POST["edit"]) {
                if ($nomePaciente === null || $idade === null || $sexo === null || $cidade === null || $estado === null || $cpf === null || $email === null || $telefone === null || $id_paciente === null) {
                    throw new Exception("Dados incompletos. Certifique-se de que todos os campos foram preenchidos.");
                }
                $pront->update_paciente($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone, $id_paciente);
                return '<div id="myAlert" class="alert alert-success text-center alert-dismissible fade show" role="alert">Paciente atualizado com sucesso</div>';
            } else {
                $registro = new controle_paciente($nomePaciente, $idade, $sexo, $cidade, $estado, $cpf, $email, $telefone);
                $registro->validar_registro_paciente();
                return '<div id="myAlert" class="alert alert-success text-center alert-dismissible fade show" role="alert">Paciente cadastrado com sucesso</div>';
            }
        } catch (Exception $e) {
            return '<div id="myAlert" class="alert alert-danger text-center alert-dismissible fade show" role="alert">' . $e->getMessage() . '</div>';
        }
    }
}

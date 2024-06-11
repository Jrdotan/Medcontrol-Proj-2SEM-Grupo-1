<?php
function salvar_prontuario()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ID_prontuario = $_POST["edit"];
        $ID_paciente = $_SESSION["id_paciente"];
        $ID_doenca = $_POST["doencaID"];
        $status_diagnostico = $_POST["statusDoenca"];
        $obito = $_POST["obito"];
        $ID_funcionario = $_SESSION["user_id"];

        $pront = new PacienteQuerys;
        try {
            if ($_POST["edit"]) {
                if ($ID_prontuario === null || $ID_doenca === null || $status_diagnostico === null || $obito === null || $ID_funcionario === null) {
                    throw new Exception("Dados incompletos. Certifique-se de que todos os campos foram preenchidos.");
                }
                $pront->update_prontuario($ID_doenca, $status_diagnostico, $obito, $ID_funcionario, $ID_prontuario);
                return '<div id="myAlert" class="alert alert-success text-center alert-dismissible fade show" role="alert">Prontuário atualizado com sucesso</div>';
            } else {
                if ($ID_paciente === null || $ID_doenca === null || $status_diagnostico === null || $obito === null || $ID_funcionario === null) {
                    throw new Exception("Dados incompletos. Certifique-se de que todos os campos foram preenchidos.");
                }
                $pront->insert_prontuario($ID_paciente, $ID_doenca, $status_diagnostico, $obito, $ID_funcionario);
                return '<div id="myAlert" class="alert alert-success text-center alert-dismissible fade show" role="alert">Prontuário preenchido com sucesso</div>';
            }
        } catch (Exception $e) {
            return '<div id="myAlert" class="alert alert-danger text-center alert-dismissible fade show" role="alert">' . $e->getMessage() . '</div>';
        }
    }
}

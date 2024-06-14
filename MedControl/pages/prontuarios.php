<?php
session_start();
require_once('./classes/db_classes.php');
require_once('./includes/crud_medcontrol.php');
include('./includes/prontuario.php');
include('./includes/paginacao.php');
$msg = salvar_prontuario();

if (!isset($_GET["id_paciente"])) {
    $_GET["id_paciente"] = $_SESSION["id_paciente"];
    $_GET["nome_paciente"] = $_SESSION["nome_paciente"];
} else {
    $_SESSION["id_paciente"] = $_GET["id_paciente"];
    $_SESSION["nome_paciente"] = $_GET["nome_paciente"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>MedControl</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/graficos.css">
</head>

<body onload="atualizarHora()">
    <nav class="navbar navbar-expand-lg bg-body-tertiary size-nav sticky-top shadow-button">
        <div class="container-fluid">
            <a class="navbar-brand m-0 nav-title-bold" href="../index.php">
                <img class="logo" src="../assets/img/Logo.svg" alt="Logo" class="d-inline-block">
                <span>MedControl</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-grow-0 text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if (isset($_SESSION["user_id"])) { //checa se sessão foi iniciada
                    ?>
                        <li class="nav-item mx-4">
                            <span class="nav-link active" aria-current="page">Bem-Vindo
                                <?php
                                echo $_SESSION["user_name"]; //Loga com nome de usuário 
                                ?>!
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="./deslogar.php">Sair</a>
                        </li>
                    <?php
                    } else {
                    ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Painel Geral</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">Login</a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (!empty($msg)) {
        echo $msg;
    }
    ?>
    <div class="py-4 py-md-3 mx-5">
        <div class="row justify-content-center">
            <div class="col-md-4 pb-3">
                <div class="card">
                    <div class="card-body text-center shadow-button">
                        <h5 style="color: #30b27f;" class="card-title title-card-md">Data e Hora Atual</h5>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <p id="Data" class="card-text data-number m-0"></p>
                                <p class="lb-grey m-0">Data</p>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <p id="Hora" class="card-text data-number m-0"></p>
                                <p class="lb-grey m-0">Hora</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="card">
                    <div class="card-body text-center shadow-button">
                        <h5 style="color: #30b27f;" class="card-title title-card-md">Quantidade de Prontuarios</h5>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <p class="card-text data-number m-0">34</p>
                                <p class="lb-grey m-0">Acumulado</p>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <p class="card-text data-number m-0">3</p>
                                <p class="lb-grey m-0">Novos Registros</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-3 text-center">
                <a class="btn btn-warning shadow-button" href="./home_pacientes.php">Voltar</a>
                <?php
                if (isset($_SESSION["user_id"])) {
                    if (!is_null($_SESSION["user_crm"])) {
                        echo '
                                <button type="button" class="btn btn-primary shadow-button" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Criar Prontuário
                                </button>
                            ';
                    }
                }
                ?>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Prontuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0 justify-content-center">
                            <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="mb-3 col-md-6">
                                    <label for="nomePaciente" class="form-label">Nome Completo: </label>
                                    <input type="text" id="nomePaciente" value="<?php echo $_SESSION["nome_paciente"] ?>" class="form-control" disabled>
                                </div>
                                <div class="mb-3 col-md-6">
                                <label for="doencaID" class="form-label">Doença:</label>
                                <select name="doencaID" id="doencaID" class="form-select" required>
                                    <option value="">Selecione uma doença</option>
                                    <option value="1">Hipertensão essencial</option>
                                    <option value="2">Diabetes mellitus</option>
                                    <option value="3">Bronquite N/C como aguda ou crônica</option>
                                    <option value="4">Pneumonia viral, N/C em outra parte</option>
                                    <option value="5">Angina pectoris</option>
                                    <option value="6">Doença respiratória viral N/E</option>
                                    <option value="7">Doença cardíaca isquêmica crônica</option>
                                    <option value="8">Outra bactéria N/E como a causa de doenças infecciosas</option>
                                    <option value="9">Insuficiência cardíaca</option>
                                    <option value="10">Dengue</option>
                                    <option value="11">Coronavírus</option>
                                    <option value="12">Pneumonia N/E</option>
                                    <option value="13">Gastrite e duodenite</option>
                                    <option value="14">Transtornos de ansiedade</option>
                                    <option value="15">Doenças do refluxo gastroesofágico</option>
                                    <option value="16">Dispepsia</option>
                                    <option value="17">Doenças renais crônicas</option>
                                    <option value="18">Insuficiência renal aguda</option>
                                    <option value="19">Hipertensão renovascular</option>
                                    <option value="20">Dislipidemia</option>
                                    <option value="21">Outras doenças pulmonares obstructivas crônicas</option>
                                    <option value="22">Asma</option>
                                    <option value="23">Fibrilação e flutter atrial</option>
                                    <option value="24">Infecções agudas das vias aéreas superiores, N/E</option>
                                    <option value="25">Síndrome do intestino irritável</option>
                                    <option value="26">Hiperplasia prostática benigna</option>
                                    <option value="27">Doenças diverticulares do intestino</option>
                                    <option value="28">Derrame cerebral não especificado como hemorrágico ou isquêmico</option>
                                    <option value="29">Outros transtornos nasais precisos</option>
                                    <option value="30">Íleo paralítico e obstrução intestinal sem hérnia</option>
                                    <option value="31">Outros transtornos do trato urinário</option>
                                    <option value="32">Enfisema</option>
                                    <option value="33">Gastroenterite e colite não infecciosa</option>
                                    <option value="34">Doenças não reumáticas da válvula aórtica</option>
                                    <option value="35">Cardiomiopatia</option>
                                </select>
                            </div>
                                <div class="mb-3 col-md-6">
                                    <label for="statusDoenca" class="form-label">Status da Doença:</label>
                                    <select name="statusDoenca" id="statusDoenca" class="form-select" required>
                                        <option value="Suspeito">Suspeito</option>
                                        <option value="Confirmado">Confirmado</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="obito" class="form-label">Óbito:</label>
                                    <select name="obito" id="obito" class="form-select">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="medico" class="form-label">Médico: </label>
                                    <input type="text" id="medico" value="<?php echo $_SESSION["user_name"] ?>" class="form-control" disabled>
                                </div>
                                <input style="display: none;" type="text" name="edit">
                                <div class="modal-footer p-0 pt-2">
                                    <button type="submit" class="px-4 btn btn-primary">Salvar Prontuário</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card overflow-x-auto shadow-button">
            <table class="card-body table table-striped table-hover m-0 table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome Paciente</th>
                        <th scope="col">Doença</th>
                        <th class="text-center" scope="col">Status da Doença</th>
                        <th class="text-center" scope="col">Óbito</th>
                        <th scope="col">Data Diagnostico</th>
                        <th scope="col">Médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $person = new PacienteQuerys();
                    $prontuarios = $person->select_all_prontuarios($_SESSION["id_paciente"], $page);
                    $medicos = '';
                    foreach ($prontuarios as $prontuario) {
                        if (isset($_SESSION["user_id"])) {
                            if (!is_null($_SESSION["user_crm"])) {
                                $medicos = "
                                    <td class='text-center'>
                                        <button type='button' class='btn btn-link p-0 mx-3 editar-pront' data-bs-toggle='modal' data-bs-target='#myModal' data-action='edit' data-id='{$prontuario['ID']}' data-nome='{$prontuario['nome_completo']}' data-doenca='{$prontuario['doenca']}' data-status='{$prontuario['status_diagnostico']}' data-obito='{$prontuario['obito']}'>
                                            <img src='../assets/img/icons/pen-to-square-solid.svg' width='20px' alt='EditarProntuario'>
                                        </button>
                                    </td>
                                ";
                            }
                        }
                        echo "
                        <tr>
                            <td>{$prontuario['nome_completo']}</td>
                            <td>{$prontuario['doenca']}</td>
                            <td class='text-center'>{$prontuario['status_diagnostico']}</td>
                            <td class='text-center'>{$prontuario['obito']}</td>
                            <td>{$prontuario['data_diagnostico']}</td>
                            <td>{$prontuario['nome']}</td>
                            $medicos
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
            <tfoot aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3">
                    <?php
                    $total_pages = $person->pagination_prontuarios($_SESSION["id_paciente"]);
                    pagination($total_pages, $page)
                    ?>
                </ul>
            </tfoot>
        </div>
    </div>
    <footer class="bd-footer py-4 mt-5 bg-body-tertiary shadow-top">
        <div class="row m-0 justify-content-center">
            <div class="col-lg p-0 text-center">
                <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
                    <img class="logo" src="../assets/img/Logo.svg" alt="Logo" class="d-inline-block">
                </a>
                <div class="mt-2">
                    <span class="nav-title-bold">MedControl</span>
                </div>
                <ul class="list-unstyled small">
                    <li class="mb-1">Projetado e construído com todo amor do mundo pelo <a href="https://github.com/Jrdotan/Projeto-2o-Semestre-Fatec---Grupo-1/graphs/contributors">Time da SmartCode</a></li>
                    <li class="mb-1">Código licenciado <a href="https://github.com/PedNeto/Projeto-2o-Semestre-Fatec/blob/main/LICENSE" target="_blank" rel="license noopener">GNU</a>, documentos <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="license noopener">CC BY 4.0</a>.</li>
                    <li class="mb-1">Atualmente v1.0</li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/medcontrol.js"></script>

</body>
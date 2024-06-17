<?php
session_start();
require_once('auth.php');
require_once('./classes/db_classes.php');
require_once("./classes/Validador_registro_paciente.php");
require_once("./classes/Gestor_registro_paciente.php");
require_once('./classes/crud_medcontrol.php');
include('./includes/paciente.php');
include('./includes/paginacao.php');
$person = new PacienteQuerys();
$msg = salvar_paciente();
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
                        <h5 style="color: #30b27f;" class="card-title title-card-md">Pessoas Registradas</h5>
                        <div class="row">
                            <?php
                            $totais = $person->registros_total_pessoas_prontuario('pessoas');
                            foreach ($totais as $total) {
                                echo "
                                    <div class='col-lg-6 mt-2'>
                                        <p class='card-text data-number m-0'>{$total['total_pessoas']}</p>
                                        <p class='lb-grey m-0'>Acumulado</p>
                                    </div>
                                    <div class='col-lg-6 mt-2'>
                                        <p class='card-text data-number m-0'>{$total['novos_registros']}</p>
                                        <p class='lb-grey m-0'>Novos Registros</p>
                                    </div>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pb-3 text-center">
                <button type="button" class="btn btn-primary shadow-button" data-bs-toggle="modal" data-bs-target="#modalPaciente">
                    Cadastrar Paciente
                </button>
            </div>
        </div>
        <div class="modal fade" id="modalPaciente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Novos Pacientes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-0 justify-content-center">
                            <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="mb-3 col-md-6">
                                    <label for="nomePaciente" class="form-label">Nome Completo: </label>
                                    <input type="text" name="nomePaciente" class="form-control" id="nomePaciente" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="idade" class="form-label">Idade: </label>
                                    <input type="text" name="idade" class="form-control" id="idade" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="sexo" class="form-label">Sexo:</label>
                                    <select id="sexo" name="sexo" class="form-select">
                                    <option selected>Selecione o sexo</option required>    
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="cidade" class="form-label">Cidade: </label>
                                    <input type="text" name="cidade" class="form-control" id="cidade" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="estado" class="form-label">Estado: </label>
                                    <select name="estado" class="form-select" id="estado" required>
                                    <option value="MG">MG</option>
                                    <option value="SP">SP</option>
                                    <option value="RJ">RJ</option>
                                    <option value="ES">ES</option>
                                    <option value="PR">PR</option>
                                    <option value="SC">SC</option>
                                    <option value="RS">RS</option>
                                    <option value="BA">BA</option>
                                    <option value="PI">PI</option>
                                    <option value="CE">CE</option>
                                    <option value="MA">MA</option>
                                    <option value="RN">RN</option>
                                    <option value="PE">PE</option>
                                    <option value="PB">PB</option>
                                    <option value="AL">AL</option>
                                    <option value="SE">SE</option>
                                    <option value="MT">MT</option>
                                    <option value="GO">GO</option>
                                    <option value="MS">MS</option>
                                    <option value="TO">TO</option>
                                    <option value="PA">PA</option>
                                    <option value="AP">AP</option>
                                    <option value="RR">RR</option>
                                    <option value="AM">AM</option>
                                    <option value="RO">RO</option>
                                    <option value="AC">AC</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="cpf" class="form-label">CPF: </label>
                                    <input type="text" name="cpf" class="form-control" id="cpf" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Endereço de Email</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="telefone" class="form-label">Telefone: </label>
                                    <input type="text" name="telefone" class="form-control" id="telefone" required>
                                </div>
                                <input style="display: none;" type="text" name="edit">
                                <div class="modal-footer p-0 pt-2">
                                    <button type="submit" name="btn-modal" class="px-4 btn btn-primary">Cadastrar</button>
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
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $pacientes = $person->select_all_pacientes($page);
                    foreach ($pacientes as $paciente) {
                        echo "
                        <tr>
                            <td>{$paciente['nome_completo']}</td>
                            <td>{$paciente['idade']}</td>
                            <td>{$paciente['sexo']}</td>
                            <td>{$paciente['cidade']}</td>
                            <td>{$paciente['estado']}</td>
                            <td>{$paciente['CPF']}</td>
                            <td>{$paciente['email']}</td>
                            <td>{$paciente['telefone']}</td>
                            <td class='text-center'>
                                <button type='button' title='Editar Paciente' class='btn btn-link p-0 me-3 editar-pront' 
                                        data-bs-toggle='modal' data-bs-target='#modalPaciente' data-action='edit' 
                                        data-id='{$paciente['ID']}' data-nome='{$paciente['nome_completo']}' 
                                        data-email='{$paciente['email']}' data-idade='{$paciente['idade']}' 
                                        data-sexo='{$paciente['sexo']}' data-cidade='{$paciente['cidade']}' 
                                        data-estado='{$paciente['estado']}' data-cpf='{$paciente['CPF']}' 
                                        data-telefone='{$paciente['telefone']}'>
                                    <img src='../assets/img/icons/pen-to-square-solid.svg' width='20px' alt='EditarProntuario'>
                                </button>
                                <button class='btn btn-link p-0' title='Prontuários' onclick=\"verProntuario('{$paciente['ID']}','{$paciente['nome_completo']}')\">
                                    <img src='../assets/img/icons/box-archive-solid.svg' width='20px' alt='Prontuarios'>
                                </button>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
            <form id="hiddenForm" action="./prontuarios.php" method="get" style="display: none;">
                <input type="hidden" name="id_paciente" id="id_paciente">
                <input type="hidden" name="nome_paciente" id="nome_paciente">
            </form>
            <tfoot aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3">
                    <?php
                        $total_pages = $person->pagination_pacientes();
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
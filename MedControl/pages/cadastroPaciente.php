<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>MedControl</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script>
        function visualizaCrm() {
            var cargoSelect = document.getElementById('cargo');
            var crmField = document.getElementById('crmFiel');

            if (cargoSelect.value === 'medico') {
                crmField.style.display = 'block';
            } else {
                crmField.style.display = 'none';
            }
            window.onload = function() {
                visualizaCrm();
            }
        }
    </script>
</head>

<body>
    <header class="bg-body-tertiary py-3 md-4 centralized-logo header-space">
        <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
            <img class="logo" src="../assets/img/Logo.svg" alt="Logo" width="75" height="83" class="d-inline-block">
        </a>
    </header>

    <div class="py-7 py-md-10" id="divCadastro">
        <div class="row m-0 justify-content-center">
            <div class="col-7 py-7 py-md-9 bg-body-tertiary shadow-button">
                <span class="titulo-login">Cadastro Paciente</span>
                <form class="row" action="./includes/paciente.php" method="post">
                    <div class="mb-3 col-md-6">
                        <label for="nomePaciente" class="form-label">Nome Completo: </label>
                        <input type="text" name="nomePaciente" class="form-control" id="nomePaciente" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="idade" class="form-label">Idade: </label>
                        <input type="text" name="idade" class="form-control" id="idade" required>
                    </div>
                    


                    <div class="form-check">
                        <label for="sexo">Sexo: </label><br>
                        <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" required>
                        <label class="form-check-label" for="sexoMasculino">Masculino
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoFeminino" value="F" required>
                        <label class="form-check-label" for="sexoFeminino">Feminino
                        </label>
                        <br><br>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="cidade" class="form-label">Cidade: </label>
                        <input type="text" name="cidade" class="form-control" id="cidade" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="estado" class="form-label">Estado: </label>
                        <input type="text" name="estado" class="form-control" id="estado" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="cpf" class="form-label">CPF: </label>
                        <input type="text" name="cpf" class="form-control" id="cpf" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Endereço de Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">Não compartilhe seu e-mail com mais ninguém.</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="telefone" class="form-label">Telefone: </label>
                        <input type="text" name="telefone" class="form-control" id="telefone" required>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary shadow-top small-footer">
        <div class="row m-0 justify-content-center">
            <div class="col-4 p-0 text-center">
                <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
                    <img class="logo" src="../assets/img/Logo.svg" alt="Logo" width="75" height="83" class="d-inline-block">
                </a>
                <div class="mt-2">
                    <span class="nav-title">MedControl</span>
                </div>
                <ul class="list-unstyled small">
                    <li class="mb-1">Projetado e construído com todo amor do mundo pelo <a href="https://github.com/Jrdotan/Projeto-2o-Semestre-Fatec---Grupo-1/graphs/contributors">Time
                            da SmartCode</a></li>
                    <li class="mb-1">Código licenciado <a href="https://github.com/PedNeto/Projeto-2o-Semestre-Fatec/blob/main/LICENSE" target="_blank" rel="license noopener">GNU</a>, documentos <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="license noopener">CC BY 4.0</a>.</li>
                    <li class="mb-1">Atualmente v1.0</li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
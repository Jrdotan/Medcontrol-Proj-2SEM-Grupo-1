<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login | MedControl</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cargoSelect = document.getElementById('cargo');
            var crmField = document.getElementById('crmFiel');
            var email = document.getElementById('divEmail');

            function adjustEmailWidth() {
                if (cargoSelect.value === 'medico') {
                    crmField.style.display = 'block';
                    email.style.width = '50%';
                } else {
                    crmField.style.display = 'none';
                    email.style.width = '100%';
                }
            }

            cargoSelect.addEventListener('change', adjustEmailWidth);
            adjustEmailWidth();
        });
    </script>
</head>

<body>
    <nav class="py-3 mb-4 centralized-logo">
        <div class="row text-center">
            <a class="col-12 navbar-brand m-0" href="../index.php">
                <img class="logo" src="../assets/img/Logo.svg" alt="Logo" class="d-inline-block">
            </a>
            <span class="col-12 mt-2 nav-title-bold">MedControl</span>
        </div>
    </nav>
    <div class="py-4 py-md-5">
        <div class="row m-0 justify-content-center">
            <div class="col-4 py-4 px-4 bg-body-tertiary shadow-button">
                <div class="py-md-2">
                    <span class="titulo-login">Efetuar Login</span>
                </div>
                <form action="./includes/logar.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-mail</label>
                        <input type="email" placeholder="digite seu e-mail" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">Não compartilhe seu e-mail com mais ninguém.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                        <input type="password" placeholder="digite sua senha" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="px-4 btn btn-primary">Entrar</button>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Novo por aqui? Cadastre-se
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Novos Funcionários</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0 justify-content-center">
                        <form class="row" action="./includes/cadastro.php" method="post">
                            <div class="mb-3 col-md-6">
                                <label for="nomeCompleto" class="form-label">Nome Completo: </label>
                                <input type="text" name="nomeCompleto" class="form-control" id="nomeCompleto" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="idade" class="form-label">Idade: </label>
                                <input type="text" name="idade" class="form-control" id="idade" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="cargo" class="form-label">Cargo:</label>
                                <select id="cargo" name="cargo" class="form-control" onchange="visualizaCrm()">
                                    <option value="funcionario">Funcionário</option>
                                    <option value="medico">Médico</option>
                                </select>

                            </div>
                            <div class="mb-3 col-md-6" id="crmFiel" style="display: none;">
                                <label for="crm" class="form-label">CRM: </label>
                                <input type="text" name="crm" class="form-control" id="crm">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="cpf" class="form-label">CPF: </label>
                                <input type="text" name="cpf" class="form-control" id="cpf" required>
                            </div>
                            <div id="divEmail" class="mb-3 col-md-6">
                                <label for="email" class="form-label">Endereço de Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text">Não compartilhe seu e-mail com mais ninguém.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" id="senha" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="senhaRepetida" class="form-label">Repita a Senha</label>
                                <input type="password" name="senhaRepetida" class="form-control" id="senhaRepetida" required>
                            </div>
                            <div class="modal-footer p-0 pt-2">
                                <button type="submit" class="px-4 btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bd-footer py-4 mt-5 bg-body-tertiary shadow-top fixed-bottom">
        <div class="row m-0 justify-content-center">
            <div class="col-4 p-0 text-center">
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
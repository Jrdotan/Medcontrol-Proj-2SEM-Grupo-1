<!DOCTYPE html>
<html lang="pt-br">


<!-- Tela de cadastro será concluida pelo sthefan -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>MedControl</title>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <div class="py-4 py-md-5">
        <div class="row m-0 justify-content-center">
            <div class="col-4 py-4 py-md-5 bg-body-tertiary shadow-button">
                <div class="text-center pb-4">
                    <span class="titulo-login">Cadastro de Funcionario</span>
                </div>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="validationDefault01" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="firstname" value="Mark" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefault02" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" name="lastname" value="Otto" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefaultUsername" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefault03" class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefault03" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefault04" class="form-label">Estado</label>
                        <select class="form-select" name="state" required>
                            <option selected disabled value="">Selecione o Estado</option>
                            <option value="SP">SP</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary shadow-top fixed-bottom">
        <div class="row m-0 justify-content-center">
            <div class="col-lg p-0 text-center">
                <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
                    <img class="logo" src="./assets/img/Logo.svg" alt="Logo" class="d-inline-block">
                </a>
                <div class="mt-2">
                    <span class="nav-title">MedControl</span>
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
</body>
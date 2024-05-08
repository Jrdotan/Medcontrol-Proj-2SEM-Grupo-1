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
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary size-nav shadow-button">
        <div class="container-fluid">
            <a class="navbar-brand m-0 nav-title" href="#">
                <img class="logo" src="./assets/img/Logo.svg" alt="Logo" class="d-inline-block">
                <span>MedControl</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-grow-0 text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if(isset($_SESSION["user_id"])){

                    ?>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><?php echo $_SESSION["user_name"]; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/deslogar.php">Deslogar</a>
                </li>
                <?php
                    }

                else{
                    ?>
                
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Painel Geral</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pages/login.php">Login</a>
                    </li>
                <?php
                }
                ?>

                </ul>
            </div>
        </div>
    </nav>
    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary shadow-top fixed-bottom">
        <div class="row m-0 justify-content-center">
            <div class="col-4 p-0 text-center">
                <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
                    <img class="logo" src="./assets/img/Logo.svg" alt="Logo" width="75" height="83" class="d-inline-block">
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
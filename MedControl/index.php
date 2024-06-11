<?php
session_start();
require_once('./pages/classes/db_classes.php');
require_once('./pages/includes/selects.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>MedControl</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/graficos.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary size-nav sticky-top shadow-button">
        <div class="container-fluid">
            <a class="navbar-brand m-0 nav-title-bold" href="#">
                <img class="logo" src="./assets/img/Logo.svg" alt="Logo" class="d-inline-block">
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Bem-Vindo <?php echo $_SESSION["user_name"];?>!</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="./pages/home_pacientes.php">Registros de Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/deslogar.php">Deslogar</a>
                        </li>
                    <?php
                    } else {
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
    <div class="py-4 py-md-2 mx-5">
        <div class="row pt-5 pb-4">
            <div class="col nav-title-bold">
                <span class="nav-title" style="letter-spacing: -1px;"><span class="nav-title-semi" style="font-size: 28px;">Painel</span> Saúde Pública</span>
                <p class="lb-grey">Atualizado em: 10/05/2024</p>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-color shadow-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Filtro de Doenças
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Filtro de Doenças</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row" action="./includes/cadastro.php" method="post">
                                <div class="">
                                    <ul style="height: 500px;" class="modal-body list-group text-start p-0 overflow-auto">
                                        <?php 
                                            $cid = new DBSelects();
                                            $cid->select_all_cids();
                                        ?>
                                    </ul>
                                    <div class="modal-footer p-0 pt-2">
                                        <button type="submit" class="px-4 btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 pb-3">
                <div class="card">
                    <div class="card-body shadow-button">
                        <h5 style="color: #30b27f;" class="card-title title-card-md">Casos Confirmados</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">342.354.354</p>
                                <p class="lb-grey">Acumulado</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">3.425</p>
                                <p class="lb-grey">Casos Novos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="card">
                    <div class="card-body shadow-button">
                        <h5 style="color: #daa520;" class="card-title title-card-md">Suspeitos</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">654.987.025</p>
                                <p class="lb-grey">Casos Suspeitos Acumulado</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">654</p>
                                <p class="lb-grey">Novos Casos Suspeitos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="card">
                    <div class="card-body shadow-button">
                        <h5 style="color: #696969;" class="card-title title-card-md">Óbitos Confirmados</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">753.159.456</p>
                                <p class="lb-grey">Óbitos Acumulados</p>
                            </div>
                            <div class="col-lg-6">
                                <p class="card-text data-number m-0">75</p>
                                <p class="lb-grey">Óbitos Novos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="title-card-md"></span>
        <div class="row pt-3 pb-4">
            <div class="col nav-title-bold">
                <span class="nav-title active" style="letter-spacing: -1px;">Síntese de casos, Suspeitas e Óbitos</span>
            </div>
        </div>
        <div class="card overflow-x-auto">
            <table class="card-body table table-striped table-hover">
                <thead>
                    <tr class="">
                        <th class="text-center" scope="col">#</th>
                        <th scope="col">Cidades</th>
                        <th scope="col">Casos</th>
                        <th scope="col">Suspeitos</th>
                        <th scope="col">Óbitos</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr>
                        <th class="text-center" scope="row">1</th>
                        <td>São Paulo</td>
                        <td>10.000</td>
                        <td>4.500</td>
                        <td>2.000</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">2</th>
                        <td>Campinas</td>
                        <td>7.500</td>
                        <td>3.500</td>
                        <td>1.800</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">3</th>
                        <td>Guarulhos</td>
                        <td>8.200</td>
                        <td>3.200</td>
                        <td>1.500</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">4</th>
                        <td>São Bernardo do Campo</td>
                        <td>9.200</td>
                        <td>6.000</td>
                        <td>2.400</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">5</th>
                        <td>Santo André</td>
                        <td>8.800</td>
                        <td>3.900</td>
                        <td>1.700</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">6</th>
                        <td>Osasco</td>
                        <td>8.100</td>
                        <td>2.300</td>
                        <td>1.200</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">7</th>
                        <td>Sorocaba</td>
                        <td>7.800</td>
                        <td>8.900</td>
                        <td>4.500</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">8</th>
                        <td>Ribeirão Preto</td>
                        <td>8.900</td>
                        <td>4.700</td>
                        <td>2.100</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">9</th>
                        <td>São José dos Campos</td>
                        <td>9.200</td>
                        <td>5.400</td>
                        <td>2.700</td>
                    </tr>
                    <tr>
                        <th class="text-center" scope="row">10</th>
                        <td>Mauá</td>
                        <td>7.800</td>
                        <td>4.600</td>
                        <td>2.200</td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">anterior</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Próximo</a>
                    </li>
                </ul>
            </nav>
        </div>
        <p class="lb-info m-0">Fonte: Vozes da minha cabeça. Leme, 2024</p>
        <!-- CASOS CONFIRMADOS DE DOENÇAS -->
        <div class="row pt-5 pb-4">
            <div class="col nav-title-bold">
                <span class="nav-title" style="letter-spacing: -1px; box-shadow: 0 5px 0px 0 #30b27f"><span class="nav-title-semi" style="font-size: 28px;">Casos</span> Confirmados</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-button" id="casosConfirmadoX"></div>
        </div>
        <p class="lb-info m-0">Fonte: Vozes da minha cabeça. Leme, 2024</p>
        <div class="row pt-3 justify-content-between m-0">
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body" id="casosConfirmadoLinhas"></div>
            </div>
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body chartMap">
                    <div class="col-md-6" id="casosConfirmadoMapa"></div>
                </div>
            </div>
        </div>
        <!-- CASOS SUSPEITOS DE DOENÇAS -->
        <div class="row pt-5 pb-4">
            <div class="col nav-title-bold">
                <span class="nav-title" style="letter-spacing: -1px; box-shadow: 0 5px 0px 0 #daa520"><span class="nav-title-semi" style="font-size: 28px;">Casos</span> Suspeitos</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-button" id="casosSuspeitosX"></div>
        </div>
        <p class="lb-info m-0">Fonte: Vozes da minha cabeça. Leme, 2024</p>
        <div class="row pt-3 justify-content-between m-0">
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body" id="casosSuspeitosLinhas"></div>
            </div>
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body chartMap">
                    <div class="col-md-6" id="casosSuspeitosMapa"></div>
                </div>
            </div>
        </div>
        <!--ÓBITOS CONFIRMADOS -->
        <div class="row pt-5 pb-4">
            <div class="col nav-title-bold">
                <span class="nav-title" style="letter-spacing: -1px; box-shadow: 0 5px 0px 0 #696969"><span class="nav-title-semi" style="font-size: 28px;">Óbitos</span> Confirmados</span>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-button" id="obitosConfirmadoX"></div>
        </div>
        <p class="lb-info m-0">Fonte: Vozes da minha cabeça. Leme, 2024</p>
        <div class="row pt-3 justify-content-between m-0">
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body" id="obitosConfirmadoLinhas"></div>
            </div>
            <div class="card col-md-6 p-0 mt-3 size-card">
                <div class="card-body chartMap">
                    <div class="col-md-6" id="obitosConfirmadoMapa"></div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bd-footer py-4 mt-5 bg-body-tertiary shadow-top">
        <div class="row m-0 justify-content-center">
            <div class="col-lg p-0 text-center">
                <a class="mb-2 text-decoration-none" href="/" aria-label="Bootstrap">
                    <img class="logo" src="./assets/img/Logo.svg" alt="Logo" class="d-inline-block">
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
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript' src="./assets/js/graficos.js"></script>
    <script type='text/javascript'>
        // Carregar mapas e gráficos relacionados aos casos confirmados
        const casosConfirmados = {
            mapa: new MapaGeoChart('casosConfirmadoMapa', 'Contaminados', ['#30b27f', '#78E36D', '#E36D72']),
            graficoX: new GraficoXChart('casosConfirmadoX', ['#E36D72', '#30b27f']),
            graficoLinha: new GraficoLinhaChart('casosConfirmadoLinhas')
        };
        carregarDados(casosConfirmados);

        // Carregar mapas e gráficos relacionados aos casos suspeitos
        const casosSuspeitos = {
            mapa: new MapaGeoChart('casosSuspeitosMapa', 'Suspeitos', ['#E36D95', '#daa520']),
            graficoX: new GraficoXChart('casosSuspeitosX', ['#E36D95', '#daa520']),
            graficoLinha: new GraficoLinhaChart('casosSuspeitosLinhas')
        };
        carregarDados(casosSuspeitos);

        // Carregar mapas e gráficos relacionados aos óbitos confirmados
        const obitosConfirmados = {
            mapa: new MapaGeoChart('obitosConfirmadoMapa', 'Óbitos', ['#B6B6B6', '#000000']),
            graficoX: new GraficoXChart('obitosConfirmadoX', ['#B6B6B6', '#000000']),
            graficoLinha: new GraficoLinhaChart('obitosConfirmadoLinhas')
        };
        carregarDados(obitosConfirmados);

        function carregarDados(dados) {
            dados.mapa.carregarMapa();
            dados.graficoX.carregarGraficoX();
            dados.graficoLinha.carregarLinhas();
        }
    </script>
</body>
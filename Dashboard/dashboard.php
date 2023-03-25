<?php
session_start();

$paginaAtiva = 'Dashboard';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../assets/conexao/conexao.php';
require_once 'assets/requests/header.php';

?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require_once 'assets/requests/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require_once 'assets/requests/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="../index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="bi bi-aspect-ratio text-white-50"></i> Visualização dos Usuarios</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jogos Registrados</div>
                                                <?php
                                                $quantidade = $result["total_jogos"];

                                                if($quantidade >= 2) {
                                                    $jogo = $quantidade . " Jogos";
                                                } else {
                                                    $jogo = $quantidade . " Jogo";
                                                }
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $jogo ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i style="font-size:2rem;" class="bi bi-joystick"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total de Votos</div>
                                                <?php
                                                $quantidade = $result_votos["total_votos"];

                                                if($quantidade >= 2) {
                                                    $voto = $quantidade . " Votos";
                                                } else {
                                                    $voto = $quantidade . " Voto";
                                                }
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $voto; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i style="font-size:2rem;" class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Quantidade de Professores</div>
                                                <?php
                                                $quantidade = $result_professores["total_professores"];

                                                if($quantidade >= 2) {
                                                    $professor = $quantidade . " Professores";
                                                } else {
                                                    $professor = $quantidade . " Professor";
                                                }
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $professor?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i style="font-size:2rem;" class="bi bi-exclamation-diamond"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Turmas Registradas</div>
                                                <?php
                                                $quantidade = $result_turmas["total_turmas"];

                                                if($quantidade >= 2) {
                                                    $turma = $quantidade . " Turmas";
                                                } else {
                                                    $turma = $quantidade . " Turma";
                                                }
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $turma;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i style="font-size:2rem;" class="bi bi-bar-chart-steps"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Estatisticas de Votos</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="myChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Jogos por Turma</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <?php foreach ($turmas as $i => $turma): ?>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-<?php echo $i % 3 == 0 ? 'primary' : ($i % 3 == 1 ? 'success' : 'info'); ?>"></i> <?php echo $turma; ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Lucas Santos 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Clique em "Sair" se estiver pronto para encerrar a sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
                    <a class="btn btn-primary" href="login.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    
    <script>
        var config = {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($turmas); ?>,
            datasets: [{
                data: <?php echo json_encode($jogos); ?>,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: 'rgba(234, 236, 244, 1)',
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: 'rgb(255,255,255)',
                bodyFontColor: '#858796',
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true,
                position: 'bottom'
            },
            cutoutPercentage: 80,
        },
    };

    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, config);

    </script>

    <script>
        var data = <?php echo $json_data; ?>;
        var table = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled:false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity:1
            },
            plotOptions: {
            },
            series: [{
                name: 'Jogos',
                data: data
            }],
            colors: '#435ebe',
            xaxis: {
                categories: ["Mar","Abr","Mai","Jun","Jul", "Ago","Set","Out","Nov","Dez"],
            },
        };
        var chart = new ApexCharts(document.querySelector("#myChart"), table);
        chart.render();
    </script>

</body>
</html>
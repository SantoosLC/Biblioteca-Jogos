<?php
session_start();

$paginaAtiva = 'Dashboard';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once 'assets/requests/conexao.php';
require_once 'assets/requests/header.php';

$sql = mysqli_query($conn, "SELECT COUNT(*) as total_jogos FROM games");
$result = mysqli_fetch_assoc($sql);

$sql_votos = mysqli_query($conn,"SELECT SUM(qntd_votos) AS total_votos FROM games");
$result_votos = mysqli_fetch_assoc($sql_votos);

$sql_turmas = mysqli_query($conn, "SELECT COUNT(*) as total_turmas FROM turmas");
$result_turmas = mysqli_fetch_assoc($sql_turmas);

// CHART

$sql_chart = "SELECT MONTH(HoraDeRegistro) AS mes, COUNT(nome_game) AS nome_game FROM games WHERE YEAR(HoraDeRegistro) = '2023' GROUP BY mes";
$result_chart = mysqli_query($conn, $sql_chart);

$data = array();
while ($row = mysqli_fetch_assoc($result_chart)) {
    $data[] = $row['nome_game'];
}

$json_data = json_encode($data);


mysqli_close($conn)
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $result["total_jogos"]; ?> Jogos</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_votos["total_votos"]?> Votos</div>
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
                                                Quantidade de Alunos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_turmas["total_turmas"];?> Turmas</div>
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
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Jogos por Turma</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> 1° DS
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> 2° DS
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> 3° DS
                                        </span>
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
                    <a class="btn btn-primary" href="login.html">Sair</a>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    
    <script>
        var data = <?php echo $json_data; ?>;
        var optionsProfileVisit = {
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
        var chart = new ApexCharts(document.querySelector("#myChart"), optionsProfileVisit);
        chart.render();
    </script>

</body>
</html>
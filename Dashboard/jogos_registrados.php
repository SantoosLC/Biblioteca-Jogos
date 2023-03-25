<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../assets/conexao/conexao.php';
require_once 'assets/requests/header.php';

$paginaAtiva = 'Jogos_Registrados'
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
                    <h1 class="h3 mb-2 text-gray-800">Jogos Registrados</h1>
                    <p class="mb-4">Aqui encontramos todos os jogos registrados na plataforma Senai Games <br> <a target="_blank"
                            href="../index.php">Acessar jogos da plataforma</a></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secundary">Jogos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Quantidade de Votos</th>
                                            <th>Turma</th>
                                            <th>Professor</th>
                                            <th>Jogo está visivel?</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Quantidade de Votos</th>
                                            <th>Turma</th>
                                            <th>Professor</th>
                                            <th>Jogo está visivel?</th>
                                        </tr>
                                    </tfoot>
                                    <?php            
                                        while($planilha_jogos = mysqli_fetch_assoc($sql_j_games)){

                                        $nome = $planilha_jogos['nome_game'];
                                        $votos = $planilha_jogos['qntd_votos'];
                                        $turma = $planilha_jogos['turma'];   
                                        $professor = $planilha_jogos['professor'];   
                                        $jogo_visivel = $planilha_jogos['visivel'];   
                                    ?>
                                    <tbody>
                                        <td> <?php echo $nome; ?> </td>
                                        <td> <?php echo $votos; ?> Votos </td>
                                        <td> <?php echo $turma; ?> </td>
                                        <td> <?php echo $professor; ?> </td>
                                        <td> <?php echo $jogo_visivel; ?> </td>
                                    </tbody>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

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

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
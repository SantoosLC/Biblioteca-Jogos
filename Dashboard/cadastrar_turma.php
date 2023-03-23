<?php
session_start();

$paginaAtiva = 'Jogos_Registrados';

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
                        <h1 class="h3 mb-0 text-gray-800">Cadastrar Turma</h1>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secundary">Dados da Turma</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    
                                    <?php 
                                    
                                     if(isset($_SESSION['arquivo_error'])) {
                                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['arquivo_error']."</p></div>";
                                        unset($_SESSION['arquivo_error']);
                                    }
            
                                    if(isset($_SESSION['arquivo_success'])) {
                                        echo "<div class='alert alert-success my-4 p-3 border'><p>".$_SESSION['arquivo_success']."</p></div>";
                                        unset($_SESSION['arquivo_success']);
                                        echo '<script>setTimeout(function() { window.location.href = "cadastrar_turma.php"; }, 1000);</script>';
                                    }
                                    ?>
    
                                    <form action="assets/requests/cadastro_turma-db.php" method="POST" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label for="nome_jogo">Nome da Turma</label>
                                            <input type="text" class="form-control" name="turma" placeholder="Nome da Turma" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_jogo">Professor</label>
                                            <input type="text" class="form-control professor" name="professor" placeholder="Professor" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_jogo">Ano</label>
                                            <input type="text" class="form-control ano" name="ano" placeholder="Ano" readonly>
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Visivel_Check" name="check" required>
                                            <label class="form-check-label" for="Visivel_Check">Confirmo os dados inseridos acima</label>
                                        </div>
                                        <br>
                                        <button type="submit" name="Lancar" class="btn btn-primary">Lançar</button>
                                    </form>
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
    
    <script type="text/javascript">

    var professor = "<?php echo $_SESSION['nome']; ?>"; 
    var ano = "<?php echo date('Y'); ?>";

    $('.professor').val(professor);
    $('.ano').val(ano);

	</script>

</body>

</html>
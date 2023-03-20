<?php
session_start();

$paginaAtiva = 'Lancar_Jogo';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once 'assets/requests/conexao.php';
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
                        <h1 class="h3 mb-0 text-gray-800">Lançar novo Jogo</h1>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secundary">Dados do Jogo</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <?php 
                                    $sql = "SELECT id, turma FROM turmas";
                                    $resultado = mysqli_query($conn, $sql);
                                    ?>

                                    <form action="assets/requests/lancar_jogo-db.php" method="POST" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label for="nome_jogo">Nome do Jogo</label>
                                            <input type="text" class="form-control" id="nome_jogo" name="nome" placeholder="Nome do jogo">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Turma</label>
                                            <?php 
                                            echo "<select class='form-control' name='opcao'>";
                                            echo '<option value="" disabled selected>Selecione uma opção</option>';
                                                while ($opcao = mysqli_fetch_assoc($resultado)) {
                                                echo "<option value='" . $opcao['turma'] . "'>" . $opcao['turma'] . "</option>";
                                                }    
                                            echo "</select>";

                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="img_jogo">Imagem do Jogo</label>
                                            <input type="text" class="form-control" id="img_jogo" name="imagem" placeholder="Imagem">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="link_jogo">Link para executar</label>
                                            <input type="text" class="form-control" id="link_jogo" name="link" placeholder="Link do Jogo">
                                            <small class="form-text text-muted">Considere o link a partir da pasta raiz do jogo Ex: Dinossauro(Pasta)/index.html</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="arquivo_jogo">Arquivo do Jogo</label>
                                            <input type="file" class="form-control-file" id="arquivo_jogo" name="arquivo" placeholder="Imagem">
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Visivel_Check" name="check">
                                            <label class="form-check-label" for="Visivel_Check">Deixar o jogo visivel</label>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
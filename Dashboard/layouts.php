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

$paginaAtiva = 'Controle';

if ($adm == 'Administrador') {
    echo "";
} else {
    header("Location: dashboard.php");
}

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
                    <h1 class="h3 mb-2 text-gray-800">Modificação de Textos</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secundary">Modificação de Layout</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Titulo Iniciação</th>
                                            <th>Sobre Iniciação</th>
                                            <th>Titulo Carrosel</th>
                                            <th>Sobre Carrosel</th>
                                            <th>Ultima Modificação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Titulo Iniciação</th>
                                            <th>Sobre Iniciação</th>
                                            <th>Titulo Carrosel</th>
                                            <th>Sobre Carrosel</th>
                                            <th>Ultima Modificação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <?php            
                                        while($textos = mysqli_fetch_assoc($textos_iniciacao_sql)){

                                        $id = $textos['id'];
                                        $titulo = $textos['titulo'];
                                        $sobre = $textos['sobre'];
                                        $titulo_carrosel = $textos['titulo_carrosel'];    
                                        $sobre_carrosel = $textos['sobre_carrosel'];    
                                        $modificado = $textos['Modifcado_Por'];    
                                    ?>
                                    <tbody>
                                        <td> <?php echo $titulo; ?> </td>
                                        <td> <?php echo $sobre; ?> </td>
                                        <td> <?php echo $titulo_carrosel; ?> </td>
                                        <td> <?php echo $sobre_carrosel; ?> </td>
                                        <td> <?php echo $modificado; ?> </td>
                                        <td> 
                                            <a type="button" style='width:50px;' class="btn btn-xs btn-success" data-toggle="modal" data-target="#AlterarLayout" 
                                            
                                            data-id="<?php echo $id; ?>"   
                                            data-titulo="<?php echo $titulo; ?>"   
                                            data-sobre="<?php echo $sobre; ?>"   
                                            data-titulo-carrosel="<?php echo $titulo_carrosel; ?>"   
                                            data-sobre-carrosel="<?php echo $sobre_carrosel; ?>"   
                                            data-usuario="<?php echo $_SESSION['nome']; ?>"   

                                            ><i class="bi bi-pencil-square" aria-hidden="true"></i></a>
                                        </td>
                                    </tbody>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Modificação de Imagens</h1>
                    <a data-toggle="modal" data-target="#CriarImagem"  class="btn btn-primary"> Adicionar Imagens </a>
                    <br>
                    <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secundary">Modificação de Layout</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Adicionado Por</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Adicionado Por</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <?php            
                                        while($img_carrosel = mysqli_fetch_assoc($img_carrosel_sql)){

                                        $id = $img_carrosel['id'];
                                        $imagem = $img_carrosel['imagem'];
                                        $adicionado_por = $img_carrosel['Adicionado_por'];
                                    ?>
                                    <tbody>
                                        <td> <?php echo $imagem; ?> </td>
                                        <td> <?php echo $adicionado_por; ?> </td>
                                        <td> 
                                            <a type="button" style='width:50px;' id="deleteImagem_<?php echo $id; ?>" data-id="<?php echo $id; ?>" data-imagem="<?php echo $imagem; ?>" class="btn btn-xs btn-danger"><i class="bi bi-x-circle" aria-hidden="true"></i> </a>
                                        </td>
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

    <!-- Modal - Confirmação para Logout -->

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

    <!-- Modal - Criar Usuario -->

    <div class="modal fade" id="CriarImagem" tabindex="-1" role="dialog" aria-labelledby="ModalImagemLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h5 class="modal-title" id="ModalImagemLabel">Modificação de Layout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
			    </div>
			    <div class="modal-body">
                    <form method="POST" action="assets/requests/lancar_imagem-db.php">

                        <div class="form-group">
                            <label for="imagem" class="control-label">Link da Imagem:</label>
                            <input name="imagem" type="text" class="form-control imagem" id="imagem" required>
                        </div>
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </form>
			    </div>
			</div>
		</div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Script - Excluir Game -->

    <script>
        $('a[id^="deleteImagem_"]').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você deseja excluir esta imagem?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'assets/requests/excluir_imagem-db.php?id=' + id;
                }
            }) 
        });
    </script>

    <script>
        if ("<?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>" != "") {

            var msg = "<?php echo $_SESSION['msg']; ?>";

            if (msg == "Layout modificado com sucesso.") {
                Swal.fire({
                    icon: 'success',
                    title: msg,
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: msg,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            <?php unset($_SESSION['msg']); ?>
        }
    </script>

    <!-- Inicializar Datatable -->

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
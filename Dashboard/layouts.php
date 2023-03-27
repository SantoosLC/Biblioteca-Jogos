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

    <div class="modal fade" id="AlterarLayout" tabindex="-1" role="dialog" aria-labelledby="AlterarLayoutLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h5 class="modal-title" id="AlterarLayoutLabel">Modificação de Layout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
			    </div>
			    <div class="modal-body">
                    <form method="POST" action="assets/requests/alterar_layout-db.php">

                        <div class="form-group">
                            <label for="titulo" class="control-label">Titulo:</label>
                            <input name="titulo" type="text" class="form-control titulo" id="titulo" required>
                        </div>

                        <div class="form-group">
                            <label for="sobre" class="control-label">Sobre:</label>
                            <input name="sobre" type="text" class="form-control sobre" id="sobre" required>
                        </div>

                        <div class="form-group">
                            <label for="titulo_carrosel" class="control-label">Titulo Carrosel:</label>
                            <input name="titulo_carrosel" type="text" class="form-control titulo_carrosel" id="titulo_carrosel" required>
                        </div>

                        <div class="form-group">
                            <label for="sobre_carrosel" class="control-label">Sobre Carrosel:</label>
                            <input name="sobre_carrosel" type="text" class="form-control sobre_carrosel" id="sobre_carrosel" required>
                        </div>

                        <div class="form-group">
                            <label for="usuario" class="control-label">Usuario Atual:</label>
                            <input name="usuario" type="text" class="form-control usuario" id="usuario" readonly>
                        </div>
                        
                        <input name="id" type="hidden" class="form-control id" id="id">

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </form>
			    </div>
			</div>
		</div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Script - Excluir Game -->

    <script>
        $('a[id^="controleUsuario_"]').click(function(e) {
            console.log('teste');
            e.preventDefault();
            var user_name = $(this).data('nome');
            var id_user = $(this).data('id');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você deseja excluir o usuario ' + user_name + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'assets/requests/excluir_usuario-db.php?id=' + id_user;
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

    <!-- Script Modal - Editar Jogos -->

    <script type="text/javascript">
		$('#AlterarLayout').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var id = button.data('id') 
		  var titulo = button.data('titulo') 
		  var sobre = button.data('sobre') 
		  var titulo_carrosel = button.data('titulo-carrosel') 
		  var sobre_carrosel = button.data('sobre-carrosel') 
		  var usuario = button.data('usuario') 

		  var modal = $(this)

		  modal.find('#id').val(id)
		  modal.find('.titulo').val(titulo)
		  modal.find('.sobre').val(sobre)
		  modal.find('.titulo_carrosel').val(titulo_carrosel)
		  modal.find('.sobre_carrosel').val(sobre_carrosel)
		  modal.find('.usuario').val(usuario)
		  
		})
	</script>

    <!-- Inicializar Datatable -->

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
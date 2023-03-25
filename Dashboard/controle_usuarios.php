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
                    <h1 class="h3 mb-2 text-gray-800">Controle de Usuario - Dashboard</h1>
                        <a data-toggle="modal" data-target="#CriarUsuario"  class="btn btn-primary"> Adicionar Usuario</a>
                        <br>
                        <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secundary">Controle de Usuarios</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Login</th>
                                            <th>E-Mail</th>
                                            <th>Função</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Login</th>
                                            <th>E-Mail</th>
                                            <th>Função</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <?php            
                                        while($planilha_usuarios = mysqli_fetch_assoc($sql_c_usuarios)){

                                        $id = $planilha_usuarios['id'];
                                        $nome = $planilha_usuarios['nome'];
                                        $login = $planilha_usuarios['login'];
                                        $email = $planilha_usuarios['email'];   
                                        $funcao = $planilha_usuarios['Funcao'];   
                                        $foto = $planilha_usuarios['foto'];   
                                        $status = $planilha_usuarios['status'];   
                                    ?>
                                    <tbody>
                                        <td> <?php echo $nome; ?> </td>
                                        <td> <?php echo $login; ?> </td>
                                        <td> <?php echo $email; ?> </td>
                                        <td> <?php echo $funcao; ?> </td>
                                        <td> <?php echo $foto; ?> </td>
                                        <td> <?php echo $status; ?> </td>
                                        <td> 
                                            <a type="button" style='width:50px;' class="btn btn-xs btn-success" data-toggle="modal" data-target="#ModalUsuario" 
                                            
                                            data-id="<?php echo $id; ?>" 
                                            data-nome="<?php echo $nome; ?>" 
                                            data-login="<?php echo $login; ?>" 
                                            data-email="<?php echo $email; ?>" 
                                            data-funcao="<?php echo $funcao; ?>" 
                                            data-foto="<?php echo $foto; ?>" 
                                            data-status="<?php echo $status; ?>" 

                                            ><i class="bi bi-pencil-square" aria-hidden="true"></i></a>

                                            <a type="button" style='width:50px;' id="controleUsuario_<?php echo $id; ?>" data-id="<?php echo $id; ?>" data-nome="<?php echo $login; ?>" class="btn btn-xs btn-danger"><i class="bi bi-x-circle" aria-hidden="true"></i> </a>
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

    <div class="modal fade" id="CriarUsuario" tabindex="-1" role="dialog" aria-labelledby="CriarUsuarioLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h5 class="modal-title" id="CriarUsuarioLabel">Criar Usuario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
			    </div>
			    <div class="modal-body">
                    <form method="POST" action="assets/requests/enviar_usuario-db.php">

                        <div class="form-group">
                            <label for="Nome" class="control-label">Nome:</label>
                            <input name="nome" type="text" class="form-control nome" id="Nome" required>
                        </div>

                        <div class="form-group">
                            <label for="login" class="control-label">Login:</label>
                            <input name="login" type="text" class="form-control login" id="login" required>
                        </div>

                        <div class="form-group">
                            <label for="senha" class="control-label">Senha Temporaria:</label>
                            <input name="senha" type="text" class="form-control senha" id="senha" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input name="email" type="text" class="form-control email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="Funcao" class="control-label">Função</label>
                            <select name="funcao" id="funcao" class="form-control funcao" required>
                                <option value="" disabled selected>Selecione uma opção</option>
                                <option value="Desenvolvedor">Desenvolvedor</option>
                                <option value="Professor">Professor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="permissao" class="control-label">Permissao</label>
                            <select name="permissao" id="permissao" class="form-control permissao" required>
                                <option value="" disabled selected>Selecione uma opção</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Padrao">Padrão</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control status" required>
                                <option value="" disabled selected>Selecione uma opção</option>                                
                                <option value="Aprovado">Aprovado</option>
                                <option value="Pendente">Pendente</option>
                            </select>
                        </div>
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
			    </div>
			</div>
		</div>
    </div>

    <!-- Modal - Editar Usuario -->

    <div class="modal fade" id="ModalUsuario" tabindex="-1" role="dialog" aria-labelledby="ModalUsuarioLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h5 class="modal-title" id="ModalUsuarioLabel">Edição de Jogo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
			    </div>
			    <div class="modal-body">
                    <form method="POST" action="assets/requests/edicao_usuario-db.php">

                        <div class="form-group">
                            <label for="Nome" class="control-label">Nome:</label>
                            <input name="nome" type="text" class="form-control nome" id="Nome">
                        </div>

                        <div class="form-group">
                            <label for="login" class="control-label">Login:</label>
                            <input name="login" type="text" class="form-control login" id="login">
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Email:</label>
                            <input name="email" type="text" class="form-control email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="Funcao" class="control-label">Função</label>
                            <select name="funcao" id="funcao" class="form-control funcao">
                                <option value="Desenvolvedor">Desenvolvedor</option>
                                <option value="Professor">Professor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Foto" class="control-label">Foto:</label>
                            <input name="foto" type="text" class="form-control foto" id="Foto">
                        </div>

                        <div class="form-group">
                            <label for="Status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control status">
                                <option value="Aprovado">Aprovado</option>
                                <option value="Pendente">Pendente</option>
                            </select>
                        </div>

                        <input name="id-user" type="hidden" class="form-control id-user" id="id-user">
                        
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

            if (msg == "Usuario excluido com sucesso.") {
                Swal.fire({
                    icon: 'success',
                    title: msg,
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (msg == "Usuario cadastrado com sucesso.") {
                Swal.fire({
                    icon: 'success',
                    title: msg,
                    showConfirmButton: false,
                    timer: 3000
                });
            } else if (msg == "Usuario modificado com sucesso.") {
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
		$('#ModalUsuario').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var id = button.data('id') 
		  var nome = button.data('nome')
		  var login = button.data('login')
		  var email = button.data('email')
		  var funcao = button.data('funcao')
		  var foto = button.data('foto')
		  var status = button.data('status')

		  var modal = $(this)

		  modal.find('#id-user').val(id)
		  modal.find('.nome').val(nome)
		  modal.find('.login').val(login)
		  modal.find('.email').val(email)
		  modal.find('.funcao').val(funcao)
		  modal.find('.foto').val(foto)
		  modal.find('.status').val(status)
		  
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
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

$paginaAtiva = 'Lancar_Jogo'
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
                    <h1 class="h3 mb-2 text-gray-800">Edição de Jogos</h1>
                    <a target="_blank" href="../index.php">Acessar jogos da plataforma</a>

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
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Quantidade de Votos</th>
                                            <th>Turma</th>
                                            <th>Professor</th>
                                            <th>Jogo está visivel?</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <?php            
                                        $sql = "SELECT * FROM games";
                                        $jogos_sql = mysqli_query($conn,$sql);
                                        while($planilha_jogos = mysqli_fetch_assoc($jogos_sql)){

                                        $id = $planilha_jogos['id'];
                                        $nome = $planilha_jogos['nome_game'];
                                        $votos = $planilha_jogos['qntd_votos'];
                                        $turma = $planilha_jogos['turma'];   
                                        $professor = $planilha_jogos['professor'];   
                                        $jogo_visivel = $planilha_jogos['visivel'];   
                                        $link = $planilha_jogos['link_iframe'];   
                                        $imagem = $planilha_jogos['img_game'];   
                                    ?>
                                    <tbody>
                                        <td> <?php echo $nome; ?> </td>
                                        <td> <?php echo $votos; ?> Votos </td>
                                        <td> <?php echo $turma; ?> </td>
                                        <td> <?php echo $professor; ?> </td>
                                        <td> <?php echo $jogo_visivel; ?> </td>
                                        <td> 
                                            <button type="button" style='width:50px;' class="btn btn-xs btn-primary" data-toggle="modal" data-target="#JogosModal" 
                                            
                                            data-id="<?php echo $id; ?>" 
                                            data-nome="<?php echo $nome; ?>" 
                                            data-turma="<?php echo $turma; ?>" 
                                            data-professor="<?php echo $professor; ?>" 
                                            data-visibilidade="<?php echo $jogo_visivel; ?>" 
                                            data-link="<?php echo $link; ?>" 
                                            data-imagem="<?php echo $imagem; ?>" 

                                            ><i class="fa fa-pen" aria-hidden="true"></i></button>
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
                    <a class="btn btn-primary" href="login.html">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Edição de Jogos -->

    <div class="modal fade" id="JogosModal" tabindex="-1" role="dialog" aria-labelledby="JogosModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			    <div class="modal-header">
                    <h5 class="modal-title" id="JogosModalLabel">Edição de Jogo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
			    </div>
			    <div class="modal-body">
                    <?php        
                        $sql = "SELECT id, turma FROM turmas";
                        $resultado = mysqli_query($conn, $sql);
                    ?>

                    <form method="POST" action="assets/requests/lancar_edicao-db.php">

                        <div class="form-group">
                            <label for="Nome" class="control-label">Nome:</label>
                            <input name="nome" type="text" class="form-control nome" id="Nome">
                        </div>

                        <div class="form-group">
                            <label for="Turma" class="control-label">Turma:</label>
                            
                            <?php 
                                echo "<select class='form-control turma' name='opcao'>";
                                echo '<option value="" disabled selected>Selecione uma opção</option>';
                                    while ($opcao = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $opcao['turma'] . "'>" . $opcao['turma'] . "</option>";
                                    }    
                                echo "</select>";
                            ?>

                        </div>

                        <div class="form-group">
                            <label for="Professor" class="control-label">Professor:</label>
                            <input name="professor" type="text" class="form-control professor" id="Professor">
                        </div>

                        <div class="form-group">
                            <label for="Visibilidade" class="control-label">Jogo está visivel?</label>
                            <select name="visibilidade" id="visibilidade" class="form-control visibilidade">
                                <option value="Não">Não</option>
                                <option value="Sim">Sim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Link-Iframe" class="control-label">Link iFrame:</label>
                            <input name="link-iframe" type="text" class="form-control link-iframe" id="Link-Iframe">
                        </div>

                        <div class="form-group">
                            <label for="Link-Imagem" class="control-label">Link Imagem:</label>
                            <input name="link-imagem" type="text" class="form-control link-imagem" id="Link-Imagem">
                        </div>

                        <input name="id-game" type="hidden" class="form-control id-game" id="id-game">
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </form>
			    </div>
			</div>
		</div>
    </div>

    <!-- Script Modal - Editar Jogos -->

    <script type="text/javascript">
		$('#JogosModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var id = button.data('id') 
		  var nome = button.data('nome')
		  var turma = button.data('turma')
		  var professor = button.data('professor')
		  var visibilidade = button.data('visibilidade')
		  var link = button.data('link')
		  var imagem = button.data('imagem')


		  var modal = $(this)
          console.log(modal.find('#id-game').val(id));

		  modal.find('#id-game').html(id)
		  modal.find('.nome').val(nome)
		  modal.find('.turma').val(turma)
		  modal.find('.professor').val(professor)
		  modal.find('.visibilidade').val(visibilidade)
		  modal.find('.link-iframe').val(link)
		  modal.find('.link-imagem').val(imagem)
		  
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
<?php
session_start();

$paginaAtiva = 'Lancar_Jogo';

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
                        <h1 class="h3 mb-0 text-gray-800">Lançar novo Jogo</h1>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secundary">Dados do Jogo</h6>
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
                                        echo '<script>setTimeout(function() { window.location.href = "dashboard.php"; }, 3000);</script>';
                                    }
                                    ?>
    
                                    <form action="assets/requests/lancar_jogo-db.php" method="POST" enctype="multipart/form-data" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_jogo">Nome do Jogo</label>
                                                    <input type="text" class="form-control" id="nome_jogo" name="nome" placeholder="Nome do jogo">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="img_jogo">Professor</label>
                                                    <input type="text" class="form-control professor" name="professor" placeholder="Professor" readonly>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Turma</label>
                                                    <?php 
                                                    echo "<select class='form-control' name='opcao'>";
                                                    echo '<option value="" disabled selected>Selecione uma opção</option>';
                                                        while ($opcao = mysqli_fetch_assoc($sql_j_turmas)) {
                                                        echo "<option value='" . $opcao['turma'] . "'>" . $opcao['turma'] . "</option>";
                                                        }    
                                                    echo "</select>";

                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="margin-top:2rem;">
                                                <div class="form-group">
                                                    <div class="borda-evandro p-3">
                                                    <div class="escrita-borda">Descrição</div>
                                                        <textarea type="text" class="form-control textarea" id="descricao" name="descricao" placeholder="Escreva aqui" rows="1" maxlength="250"></textarea>
                                                    </div>
                                                <small class="form-text text-muted text-right"><span id="caracteres">250</span> Caracteres Restantes</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6" style="margin-top:2rem;">
                                                <div class="form-group">
                                                        <div class="borda-evandro p-3">
                                                        <div class="escrita-borda">Alunos</div>
                                                            <div id="alunos-input">
                                                                <input type="text" class="form-control textarea" name="alunos[]" placeholder="Insira o nome do aluno">
                                                            </div>
                                                        </div>
                                                    <button type="button" class="btn btn-primary" style="border-radius:55px; width:100%; margin-top:5px;" onclick="botaoMais()">Adicionar aluno  <i class="bi bi-plus-circle"></i></button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="link_jogo">Link para executar</label>
                                                    <input type="text" class="form-control" id="link_jogo" name="link" placeholder="Link do Jogo">
                                                    <small class="form-text text-muted">Considere o link a partir da pasta raiz do jogo Ex: Dinossauro(Pasta)/index.html</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="arquivo_jogo">Arquivo do Jogo</label>
                                                    <input type="file" class="form-control-file" id="arquivo_jogo" name="arquivo" placeholder="Imagem">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="img_jogo">Imagem do Jogo</label>
                                                    <input type="file" class="form-control-file" id="imagem" name="imagem" placeholder="Imagem">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Visivel_Check" name="check">
                                                    <label class="form-check-label" for="Visivel_Check">Deixar o jogo visivel</label>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-12">
                                                <button type="submit" name="Lancar" class="btn btn-primary">Lançar Jogo</button>
                                            </div>
                                        </div>
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

    <script>
		function botaoMais() {
			var div = document.getElementById("alunos-input");
			var aluno_input = document.createElement("input");
			aluno_input.type = "text";
            aluno_input.name = "alunos[]";
            aluno_input.classList.add("form-control");
            aluno_input.classList.add("textarea");
            aluno_input.style.marginTop = "10px";
            aluno_input.placeholder = "Insira o nome do aluno";
			div.appendChild(aluno_input);
		}

        var descricao = document.getElementById("descricao");

        descricao.addEventListener("input", function() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
	</script>

    <script type="text/javascript">

    var input = document.getElementById("descricao");
    var contador = document.getElementById("caracteres");
    var limite = input.getAttribute("maxlength");

    input.addEventListener("input", function() {
    var caracteresDigitados = input.value.length;
    var caracteresRestantes = limite - caracteresDigitados;
    
    contador.innerHTML = caracteresRestantes;
    });

    var professor = "<?php echo $_SESSION['nome']; ?>"; 

    $('.professor').val(professor);

    </script>
    
</body>

</html>
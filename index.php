<?php
    session_start();
    include_once("assets/conexao/conexao.php");

    if(isset($_GET['turma'])) {
        $filtro_turma = ($_GET['turma']) ? "WHERE turma='" . $_GET['turma'] . "'" : "";
    } else {
        $filtro_turma = "Todos";
    }

    $turmas_result = mysqli_query($conn, "SELECT DISTINCT turma FROM turmas");

    $games_result = mysqli_query($conn, "SELECT * FROM games " . $filtro_turma);

    $games_votos = "SELECT nome_game, SUM(qntd_votos) AS total_votos FROM games GROUP BY nome_game ORDER BY total_votos DESC";
    $games_result_votos = mysqli_query($conn, $games_votos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construct 3 - Games Developer</title>
    <!-- Icone da Pagina -->
    <link rel="shortcut icon" href="assets/images/icon-512.png" type="image/x-icon">
    <!-- Font Poppins -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/a947e5abc9.css" crossorigin="anonymous">
    <!-- Arquivo de estilização -->
    <link rel="stylesheet" href="assets/style/style.css">

    <style>
        * {
            font-family: 'Poppins';
        }

        body {
            background-image: url('assets/images/corel-vector.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
    <body style="padding-top:5rem;">

        <!-- Header com uma logo e botao de login -->

        <header class="fixed-top">
            <nav class="navbar borda-redonda-bottom navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                    <img src="assets/images/image.png" alt="Logo" height="50">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" href="index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                        <span class="navbar-text mx-2">.</span>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="iniciacao.php">Iniciação Profissional</a>
                        </li>
                        <li class="nav-item">
                        <span class="navbar-text mx-2">.</span>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="Dashboard/login.php">Painel do Professor</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Fim da Header -->


        <!-- Sistema de votação entre os jogos disponiveis no banco de dados -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="align-self-center p-5">

                    <!-- Filtro por Turma/Ano -->

                    <form method="GET">
                        <div class="mb-3">
                            <label for="turma" style="color:white;" class="form-label">Filtrar por Turma:</label>
                            <select class="form-select" id="turma" name="turma">
                            <option value="">Todas</option>
                            <?php
                                while($turma_row = mysqli_fetch_assoc($turmas_result)){
                                $selected = ($turma_row['turma'] == $_GET['turma']) ? 'selected' : '';
                                echo "<option value='" . $turma_row['turma'] . "' " . $selected . ">" . $turma_row['turma'] . "</option>";
                                }
                            ?>
                            </select>
                            <button type="submit" class="btn btn-purple">Filtrar</button>

                            <div class="borda-separacao-2"></div>

                        </div>
                    </form>

                    <!-- Filtro por Turma/Ano -->

                    <?php
                        while($games_row = mysqli_fetch_assoc($games_result)){
                    ?>
                        <h4 style="color:white;"> <?php echo $games_row['nome_game']; ?></h4>
                        <img class="img_game" src="<?php echo $games_row['img_game']; ?>">
                            <div class="descricao">
                                <a data-bs-toggle="modal" data-bs-target="#Games-Modal" data-alunos="<?php echo $games_row['alunos']; ?>" data-professor="<?php echo $games_row['professor']; ?>" data-turma="<?php echo $games_row['turma'];?>" data-descricao="<?php echo $games_row['descricao']; ?>" data-name="<?php echo $games_row['nome_game']; ?>" data-link="<?php echo $games_row['link_iframe']; ?>" class="btn btn-purple">
                                    Abrir Jogo
                                </a>
                                <a style="margin-left:8.5rem;" href="#" id="confirmLink_<?php echo $games_row['id']; ?>" data-name="<?php echo $games_row['nome_game']; ?>" data-id="<?php echo $games_row['id']; ?>" class="btn btn-purple">
                                    Votar
                                </a>
                            </div>
                            <div class="borda-separacao"></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 p-5 text-center">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Posição</th>
                                <th>Jogo</th>
                                <th>Votos</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $posicao = 1;
                            while ($games_votos_row = mysqli_fetch_assoc($games_result_votos)) {
                                echo "<tr>";
                                echo "<td>" . $posicao . "</td>";
                                echo "<td>" . $games_votos_row["nome_game"] . "</td>";
                                echo "<td>" . $games_votos_row["total_votos"] . "</td>";
                                echo "</tr>";
                                $posicao++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do Sistema de Votacao -->

        <!-- Modal -->
        <div class="d-flex align-items-center justify-content-center">
            <div class="modal fade" id="Games-Modal" tabindex="-1" aria-labelledby="Games-ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Jogo do Senai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="modal-content">
                                    <div class="col-md-24">
                                        <div class="text-center">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" style="border-radius:15px;" src="" width="450rem" height="400rem"></iframe> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-24">
                                        <div class="form-group">
                                            <label for="arquivo_jogo">Professor</label>
                                            <input type="text" class="professor form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="arquivo_jogo">Turma</label>
                                            <input type="text" class="turma form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="alunos-jogo">Alunos:</label>
                                            <textarea class="form-control alunos" rows="3" maxlength="150" disabled></textarea>
                                        </div>    
                                        <div class="form-group">
                                            <label for="detalhes-jogo">Descrição do Jogo:</label>
                                            <textarea class="form-control descricao" rows="3" maxlength="150" disabled></textarea>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do modal -->

        <!-- Footer Lucas Santos -->
        <footer class="footer fixed-bottom mt-auto bg-dark text-white py-2 borda-redonda-top">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">Desenvolvedor Web: Lucas Santos - <a href="https://www.linkedin.com/in/santosluca" target="_blank" class="text-decoration-none text-white">
                        LinkedIn <i class="fab fa-linkedin fa-lg me-2"></i>
                    </a></p> 
                    <p class="mb-0">Orientador: Prof. Evandro Soares - <a href="https://www.linkedin.com/in/evandro-soares-ribas-dev/" target="_blank" class="text-decoration-none text-white">
                        LinkedIn <i class="fab fa-linkedin fa-lg me-2"></i>
                    </a></p>
                </div>
            </div>
        </div>
        </footer>
        <!-- Fim do Footer -->

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <!-- Bootrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/a947e5abc9.js" crossorigin="anonymous"></script>

        <!-- Modal para exibição do jogo -->
        <script>
            $('#Games-Modal').on('show.bs.modal', function (event) {
                $('.container').addClass('efeito-blur');
                $('header').addClass('efeito-blur');
                
                var button = $(event.relatedTarget)
                var game_link = button.data('link')
                var game_name = button.data('name')
                var game_professor = button.data('professor')
                var game_turma = button.data('turma')
                var game_descricao = button.data('descricao')
                var game_alunos = button.data('alunos')

                var modal = $(this)
                modal.find('iframe').attr('src', game_link) 
                modal.find('.modal-title').text(game_name)
                modal.find('.professor').val(game_professor)
                modal.find('.turma').val(game_turma)
                modal.find('.descricao').val(game_descricao)
                modal.find('.alunos').val(game_alunos)
            })

            $('#Games-Modal').on('hide.bs.modal', function (event) {
                $('.container').removeClass('efeito-blur');
                $('header').removeClass('efeito-blur');
                $('iframe').attr('src'  , '');
            })

        </script>    
        <!-- Fim do Modal do Jogo  -->

        <!-- Msg Session vinda do sistema de votação, melhor experiencia para o usuario -->
        <script>
                if ("<?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>" != "") {

                var msg = "<?php echo $_SESSION['msg']; ?>";

                if (msg == "Recebemos seu voto com sucesso, obrigado por participar!") {
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
        <!-- Fim da mensagem -->

        <!-- SweetAlert Confirmação de votação -->
        
        <script>
        $('a[id^="confirmLink_"]').click(function(e) {
            e.preventDefault();
            var game_name = $(this).data('name');
            var game_id = $(this).data('id');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você deseja confirmar seu voto no Jogo do ' + game_name + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Votar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'votacao.php?id=' + game_id;
                }
            }) 
        });
        </script>

        <!-- Fim SweetAlert -->

    </body>
</html>
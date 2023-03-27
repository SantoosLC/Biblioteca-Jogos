<?php
    session_start();
    include_once("assets/conexao/conexao.php");
    $textos_iniciacao = mysqli_fetch_assoc($textos_iniciacao_sql);
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
            background-color: #ECECEC;
            background-size: cover;
            background-repeat: repeat;
        }
    </style>
</head>
    <body style="padding-top:5rem;">

        <!-- Header com uma logo e botao de login -->
        <header class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                        <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                        <span class="navbar-text mx-2">.</span>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="iniciacao.php">Iniciação Profissional</a>
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

        <section class="caixa">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="">
                            <h2><?php echo $textos_iniciacao['titulo']?></h2>
                            <p>
                                <?php echo $textos_iniciacao['sobre']?>
                            </p>
                            <a href="" class="btn btn-purple">Saiba Mais</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img style="border-radius:15px;" src="assets/images/wpp.jpg" width="auto" alt="" class="img-fluid">
                    </div>
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                </div>
            </div>
        </section>

        <section>
        <div class="container d-flex align-items-center justify-content-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide carousel-section" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="text-center">
                        <h2><?php echo $textos_iniciacao['titulo_carrosel']?></h2>
                        <br>
                        <p>
                            <?php echo $textos_iniciacao['sobre_carrosel']?>
                        </p>
                    </div>
                    <?php

                    while($img_row = mysqli_fetch_assoc($img_carrosel_sql)){
                        echo "<div class='carousel-item active'>
                        <img src='" . $img_row['imagem'] . "' class='d-block w-100 carousel-item-img' alt='...'>
                        </div>
                        ";}
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        </section>

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
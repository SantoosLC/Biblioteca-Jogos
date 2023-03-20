<?php 
session_start();

require_once 'assets/requests/header.php';
?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem Vindo!</h1>
                                    </div>

                                    <?php 
                                    
                                    if(isset($_SESSION['login_error'])) {
                                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['login_error']."</p></div>";
                                        unset($_SESSION['login_error']);
                                    }
            
                                    if(isset($_SESSION['login_success'])) {
                                        echo "<div class='alert alert-success my-4 p-3 border'><p>".$_SESSION['login_success']."</p></div>";
                                        unset($_SESSION['login_success']);
                                        echo '<script>setTimeout(function() { window.location.href = "dashboard.php"; }, 3000);</script>';
                                    }

                                    ?>

                                    <form class="user" action="assets/requests/verifica_login.php" method="POST">
                                        <div class="form-group">
                                            <input type="user" class="form-control form-control-user"
                                                name="usuario" aria-describedby="emailHelp"
                                                placeholder="Usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="senha" placeholder="Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar</label>
                                            </div>
                                        </div>
                                        <button type="submit" href="index.html" class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="bi bi-google"></i> Entrar com Google
                                        </a>
                                        <a href="index.html" class="btn btn-github btn-user btn-block">
                                            <i class="bi bi-github"></i> Entrar com Github
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Esqueci minha senha</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="registro.php">Criar conta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
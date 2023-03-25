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
                                        <h1 class="h4 text-gray-900 mb-4">Primeiro Login!</h1>
                                    </div>

                                    <?php 
                                    
                                    if(isset($_SESSION['error_senha'])) {
                                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['error_senha']."</p></div>";
                                        unset($_SESSION['error_senha']);
                                    }

                                    ?>

                                    <form class="user" action="assets/requests/primeiro_login.php" method="POST">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="senha" aria-describedby="emailHelp"
                                                placeholder="Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="confirmar-senha" placeholder="Confirmar Senha" required>
                                        </div>

                                        <button type="submit" href="index.html" class="btn btn-primary btn-user btn-block">
                                            Confirmar Senha
                                        </button>
                                    </form>
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
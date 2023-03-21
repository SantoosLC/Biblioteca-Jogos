<?php
session_start();
require_once '../../../assets/conexao/conexao.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$query = "SELECT * FROM web_login WHERE login = '$usuario' AND senha = '$senha' AND status = 'aprovado'";
$resultado = mysqli_query($conn,$query);
$dados = mysqli_fetch_array($resultado);

if (mysqli_num_rows($resultado) == 1) {
  session_start();

  $_SESSION['usuario'] = $usuario;
  $_SESSION['nome'] = $dados['nome'];
  $_SESSION['funcao'] = $dados['Funcao'];
  $_SESSION['foto'] = $dados['foto'];
  $_SESSION['usuario_logado'] = true;

  $_SESSION['login_success'] = "Entrando, aguarde...";
  header('Location: ../../login.php');
  exit();
} else {
    $_SESSION['login_error'] = "Email ou Senha inválidos.";
    header('Location: ../../login.php');
    exit();
}

mysqli_close($conn);
?>
<?php
session_start();
require_once 'conexao.php';

// Recebe os dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Verifica se o email e a senha correspondem a um usuário na tabela
$query = "SELECT * FROM web_login WHERE login = '$usuario' AND senha = '$senha' AND status = 'aprovado'";
$resultado = mysqli_query($conn,$query);
$dados = mysqli_fetch_array($resultado);

if (mysqli_num_rows($resultado) == 1) {
  // O usuário foi autenticado com sucesso
  session_start();

  $_SESSION['usuario'] = $usuario;
  $_SESSION['nome'] = $dados['nome'];
  $_SESSION['funcao'] = $dados['Funcao'];
  $_SESSION['usuario_logado'] = true;

  $_SESSION['login_success'] = "Entrando, aguarde...";
  header('Location: ../../login.php');
  exit();
} else {
  // Email ou senha inválidos
    $_SESSION['login_error'] = "Email ou Senha inválidos.";
    header('Location: ../../login.php');
    exit();
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
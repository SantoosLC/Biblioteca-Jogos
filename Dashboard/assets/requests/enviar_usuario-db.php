<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$funcao = $_POST['funcao'];
$permissao = $_POST['permissao'];
$status = $_POST['status'];

$usuario_sql = "INSERT web_login(nome, login, senha, email, funcao, permissao, status) VALUES ('$nome','$login','$senha','$email','$funcao','$permissao','$status')";

$usuario_existe = mysqli_query($conn, "SELECT * FROM web_login WHERE login = '$login'");

if(mysqli_num_rows($usuario_existe) > 0) {
    $_SESSION['msg'] = 'Esse usuario já esta cadastrado.';
    header("Location: ../../controle_usuarios.php");
  } else {
    $lancar_usuario = mysqli_query($conn, $usuario_sql);
    $_SESSION['msg'] = 'Usuario cadastrado com sucesso.';
    header("Location: ../../controle_usuarios.php");
  }

?>
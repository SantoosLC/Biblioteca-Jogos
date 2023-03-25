<?php
session_start();

require_once '../../../assets/conexao/conexao.php'; 

    $login = $_SESSION['primeiro_login'];
    $senha = $_POST['senha'];

    $atualizar_usuario = mysqli_query($conn, "UPDATE web_login SET senha='$senha', primeiro_login=1 WHERE login='$login'");

    header("Location: ../../login.php");

?>
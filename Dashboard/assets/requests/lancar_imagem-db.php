<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

    $imagem = $_POST['imagem'];
    $user = $_SESSION['nome'];

    $lancar_img = "INSERT imagens(imagem,Adicionado_por) VALUES('$imagem','$user')";
    $img = mysqli_query($conn, $lancar_img);

    header("Location: ../../layouts.php");

?>
<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

    $id = $_POST['id-game'];
    $nome = $_POST['nome'];
    $turma = $_POST['opcao'];
    $professor = $_POST['professor'];
    $visibilidade = $_POST['visibilidade'];
    $link_iframe = $_POST['link-iframe'];
    $link_imagem = $_POST['link-imagem'];

    $atualizar_jogo = "UPDATE games SET nome_game='$nome', img_game='$link_imagem', turma='$turma', link_iframe='$link_iframe', professor='$professor', visivel='$visibilidade'  WHERE id='$id'";
    $jogo = mysqli_query($conn, $atualizar_jogo);

    header("Location: ../../dashboard.php");

?>
<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$excluir_imagem_db = "DELETE FROM imagens WHERE id ='$id'"; 
	$excluir = mysqli_query($conn, $excluir_imagem_db);

	header("Location: ../../layouts.php");

}


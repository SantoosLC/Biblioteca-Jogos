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
	$excluir_jogo_db = "DELETE FROM games WHERE id ='$id'"; 
	$excluir = mysqli_query($conn, $excluir_jogo_db);
	
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Jogo excluido com sucesso.";
		header("Location: ../../jogos_edicao.php");
	}else{
		$_SESSION['msg'] = "Erro ao excluir o jogo";
		header("Location: ../../jogos_edicao.php");
	}
}


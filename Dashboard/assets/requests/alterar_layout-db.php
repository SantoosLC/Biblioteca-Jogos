<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $sobre = $_POST['sobre'];
    $titulo_carrosel = $_POST['titulo_carrosel'];
    $sobre_carrosel = $_POST['sobre_carrosel'];
    $usuario = $_POST['usuario'];

    $atualizar_textos = "UPDATE textos SET titulo='$titulo', sobre='$sobre', titulo_carrosel='$titulo_carrosel', sobre_carrosel='$sobre_carrosel', Modifcado_Por='$usuario'  WHERE id='$id'";
    $textos = mysqli_query($conn, $atualizar_textos);

    if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Layout modificado com sucesso.";
        header("Location: ../../layouts.php");
	}else{
		$_SESSION['msg'] = "Erro ao modificar layout.";
        header("Location: ../../layouts.php");
	}
?>
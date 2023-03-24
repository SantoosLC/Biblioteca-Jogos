<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

    $id = $_POST['id-user'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];
    $foto = $_POST['foto'];
    $status = $_POST['status'];

    $atualizar_user = "UPDATE web_login SET nome='$nome', login='$login', email='$email', Funcao='$funcao', foto='$foto', status='$status'  WHERE id='$id'";
    $user = mysqli_query($conn, $atualizar_user);

    if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "Usuario modificado com sucesso.";
        header("Location: ../../controle_usuarios.php");
	}else{
		$_SESSION['msg'] = "Erro ao modificar usuario.";
        header("Location: ../../controle_usuarios.php");
	}
?>
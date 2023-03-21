<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

if(isset($_POST["Lancar"])) {
	$target_dir = "../../../Jogos";
	$target_file = $target_dir . basename($_FILES["arquivo"]["name"]); 
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
	
	if($imageFileType != "zip") {
		$_SESSION['arquivo_error'] = "Somente arquivos ZIP são permitidos.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION['arquivo_error'] = "O Arquivo não foi enviado.";
	} else {
		if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {

			$zip = new ZipArchive;
			if ($zip->open($target_file) === TRUE) {
			    $zip->extractTo($target_dir);
			    $zip->close();
			    $_SESSION['arquivo_success'] = "Arquivo enviado com sucesso";
			} else {
			    $_SESSION['arquivo_error'] = "Erro ao extrair arquivo ZIP.";
			}
		} else {
			$_SESSION['arquivo_error'] = "Erro ao enviar o arquivo, tente novamente.";
		}
	}

    $nome = $_POST['nome'];
    $img_game = $_POST['imagem'];
    $turma = $_POST['opcao'];
    $link_iframe = $_POST['link'];

    if (isset($_POST['check'])) {
        $jogo_visivel = "Sim";
    } else {
        $jogo_visivel = "N達o";
    }

	$data = date("Y-m-d H:i:s");

    $lancar_jogo = "INSERT games(nome_game, img_game, turma, link_iframe ,visivel, HoraDeRegistro) VALUES ('$nome', '$img_game', '$turma', 'Jogos/$link_iframe', '$jogo_visivel', '$data')";
    $jogo = mysqli_query($conn, $lancar_jogo);

    header("Location: ../../lancar_jogo.php");
}
?>
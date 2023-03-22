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

	// Enviar arquivo da imagem

	$imagem_nome = $_FILES["imagem"]["name"];
	$imagem_temp = $_FILES["imagem"]["tmp_name"];
	$nome = $_POST["nome"];

	$extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);
	$novo_nome = $nome . "." . $extensao;

	$diretorio_destino = "../../../imagens-jogos/" . $novo_nome;
	
	if(!is_dir("../../../imagens-jogos")) {
		mkdir("../../../imagens-jogos");
	}
	
	move_uploaded_file($imagem_temp, $diretorio_destino);

	// SQL

    $img_game = 'https://localhost/biblioteca-jogos/imagens-jogos/'. $novo_nome;
    $turma = $_POST['opcao'];
    $link_iframe = $_POST['link'];
	$professor = $_SESSION['nome'];
	
    if (isset($_POST['check'])) {
        $jogo_visivel = "Sim";
    } else {
        $jogo_visivel = "Não";
    }

	$data = date("Y-m-d H:i:s");

    $lancar_jogo = "INSERT games(nome_game, img_game, turma, link_iframe , professor, visivel, HoraDeRegistro) VALUES ('$nome', '$img_game', '$turma', 'Jogos/$link_iframe', '$professor', '$jogo_visivel', '$data')";
    $jogo = mysqli_query($conn, $lancar_jogo);

    header("Location: ../../lancar_jogo.php");
}
?>
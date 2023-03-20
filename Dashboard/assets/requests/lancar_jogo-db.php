<?php

require_once './conexao.php'; 

if(isset($_POST["Lancar"])) {
	$target_dir = "../../../Jogos";
	$target_file = $target_dir . basename($_FILES["arquivo"]["name"]); // Caminho completo do arquivo a ser salvo
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Extensão do arquivo
	if($imageFileType != "zip") {
		echo "Erro: somente arquivos ZIP são permitidos.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "Erro: o arquivo não foi enviado.";
	} else {
		if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
			echo "O arquivo ". basename( $_FILES["arquivo"]["name"]). " foi enviado com sucesso.";
			$zip = new ZipArchive;
			if ($zip->open($target_file) === TRUE) {
			    $zip->extractTo($target_dir);
			    $zip->close();
			    echo "O arquivo ZIP foi extraído com sucesso.";
			} else {
			    echo "Erro ao extrair o arquivo ZIP.";
			}
		} else {
			echo "Erro ao enviar o arquivo.";
		}
	}

    $nome = $_POST['nome'];
    $img_game = $_POST['imagem'];
    $turma = $_POST['opcao'];
    $link_iframe = $_POST['link'];

    if (isset($_POST['check'])) {
        $jogo_visivel = "Sim";
    } else {
        $jogo_visivel = "Não";
    }

	$data = date("Y-m-d H:i:s");

    $lancar_jogo = "INSERT games(nome_game, img_game, turma, link_iframe ,visivel, HoraDeRegistro) VALUES ('$nome', '$img_game', '$turma', 'Jogos/$link_iframe', '$jogo_visivel', '$data')";
    $jogo = mysqli_query($conn, $lancar_jogo);

    header("Location: ../../dashboard.php");
}
?>
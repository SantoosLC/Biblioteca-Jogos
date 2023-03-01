<?php
session_start();
include_once("assets/conexao/conexao.php");

// Verifica se o usuario já voltou

if(isset($_GET['id'])){
	if(isset($_COOKIE['game_votado'])){
		$_SESSION['msg'] = "Já detectamos seu voto, tente novamente em instantes.";
		header("Location: index.php");
	}else{

        // Caso não tenha votado, seta um timer
        
		setcookie('game_votado', $_SERVER['REMOTE_ADDR'], time() + 60);

        // Update do banco de dados, computando o voto do usuario

		$games_result_votos = "UPDATE games SET qntd_votos=qntd_votos + 1 WHERE id ='".$_GET['id']."'"; 
		$games = mysqli_query($conn, $games_result_votos);
		
        // Confirmação de Voto

		if(mysqli_affected_rows($conn)){
			$_SESSION['msg'] = "Recebemos seu voto com sucesso, obrigado por participar!";
			header("Location: index.php");
		}else{
			$_SESSION['msg'] = "Erro ao votar!";
			header("Location: index.php");
		}
	}
}


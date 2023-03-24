<?php
// Conexão com o banco de dados

$servidor = "localhost"; // Servidor
$usuario = "root"; // Usuario DB
$senha = "root"; // Senha DB
$db = "SenaiGames"; // Nome do Banco de Dados

$conn = mysqli_connect($servidor, $usuario, $senha, $db);


// SQL's - Dashboard

    // dashboard.php

    $sql = mysqli_query($conn, "SELECT COUNT(*) as total_jogos FROM games");
    $result = mysqli_fetch_assoc($sql);

    $sql_votos = mysqli_query($conn, "SELECT SUM(qntd_votos) AS total_votos FROM games");
    $result_votos = mysqli_fetch_assoc($sql_votos);

    $sql_turmas = mysqli_query($conn, "SELECT COUNT(*) as total_turmas FROM turmas");
    $result_turmas = mysqli_fetch_assoc($sql_turmas);

    $sql_profesores = mysqli_query($conn, "SELECT COUNT(*) as total_professores FROM web_login");
    $result_professores = mysqli_fetch_assoc($sql_profesores);

    $sql_chart = mysqli_query($conn, "SELECT MONTH(HoraDeRegistro) AS mes, COUNT(nome_game) AS nome_game FROM games WHERE YEAR(HoraDeRegistro) = '2023' GROUP BY mes");

    if(mysqli_num_rows($sql_chart) > 0) {
        while ($row_chart = mysqli_fetch_assoc($sql_chart)) {
            $nome_game[] = $row_chart['nome_game'];
        }
      } else {
        $nome_game = "";
      }

    $json_data = json_encode($nome_game);

    $sql_chart_pie = mysqli_query($conn, "SELECT games.turma, COUNT(games.id) as jogos FROM games GROUP BY games.turma");

    if(mysqli_num_rows($sql_chart_pie) > 0) {
        while ($row_chart_pie = mysqli_fetch_assoc($sql_chart_pie)) {
            $turmas[] = $row_chart_pie['turma'];
            $jogos[] = $row_chart_pie['jogos'];
        }
      } else {
        $turmas[] = "Sem jogos lançados";
        $jogos[] = "Sem jogos lançados";
      }

    

    // Jogos_edicao.php / Jogos_registrados.php / lancar_jogo.php

    $sql_j_turmas = mysqli_query($conn, "SELECT id, turma FROM turmas");

    $sql_j_games = mysqli_query($conn, "SELECT * FROM games");

?>
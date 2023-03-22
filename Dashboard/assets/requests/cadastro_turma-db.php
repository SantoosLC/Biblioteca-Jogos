<?php
session_start();

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: login.php");
    exit();
}

require_once '../../../assets/conexao/conexao.php'; 

$professor = $_POST['professor'];
$ano = $_POST['ano'];
$turma = $_POST['turma'];

$turma_sql = "INSERT turmas(turma, ano, Professor) VALUES ('$turma','$ano','$professor')";

$turma_existe = mysqli_query($conn, "SELECT * FROM turmas WHERE turma = '$turma'");

if(mysqli_num_rows($turma_existe) > 0) {
    $_SESSION['arquivo_error'] = 'Essa turma já esta cadastrada.';
    header("Location: ../../cadastrar_turma.php");
  } else {
    $lancar_turma = mysqli_query($conn, $turma_sql);
    $_SESSION['arquivo_success'] = 'Turma cadastrada com sucesso.';
    header("Location: ../../cadastrar_turma.php");
  }

?>
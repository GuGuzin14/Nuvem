<?php
session_start();
include 'conexao.php';

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM administradores WHERE usuario='$usuario' AND senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['logado'] = true;
    header("Location: painel.php");
} else {
    echo "Usuário ou senha inválidos.";
}
?>

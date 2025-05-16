<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM autores WHERE id=$id";

if($conn->query($sql)) {
    header("Location: autores.php");
} else {
    echo "Erro ao excluir autor: " . $conn->error;
}
?>

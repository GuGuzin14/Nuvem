<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM livros WHERE id=$id";

if($conn->query($sql)) {
    header("Location: livros.php");
} else {
    echo "Erro ao excluir livro: " . $conn->error;
}
?>

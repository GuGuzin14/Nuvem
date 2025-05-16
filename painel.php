<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
?>
<head><link rel="stylesheet" href="assets/style.css"></head>
<h1>Painel Administrativo</h1>
<a href="livros.php">Gerenciar Livros</a> | 
<a href="autores.php">Gerenciar Autores</a> |
<a href="logout.php">Sair</a>

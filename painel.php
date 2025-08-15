<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Painel Administrativo</h1>
    <div class="nav">
        <a href="livros.php">Gerenciar Livros</a>
        <a href="autores.php">Gerenciar Autores</a>
        <a href="cadastrar_admin.php">Novo Admin</a>
        <a href="logout.php">Sair</a>
    </div>
    <p>Bem-vindo! Use o menu para gerenciar o sistema.</p>
</div>
</body>
</html>

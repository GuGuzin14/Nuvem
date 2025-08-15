<?php
session_start();
include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$usuario = trim($_POST['usuario'] ?? '');
$senhaEntrada = $_POST['senha'] ?? '';
$senhaHash = md5($senhaEntrada);

// Prepared statement para evitar SQL Injection
$stmt = $conn->prepare('SELECT id FROM administradores WHERE usuario = ? AND senha = ? LIMIT 1');
$stmt->bind_param('ss', $usuario, $senhaHash);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    $_SESSION['logado'] = true;
    header('Location: painel.php');
    exit;
} else {
    header('Location: login.php?erro=1');
    exit;
}
?>

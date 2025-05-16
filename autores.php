<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
include 'conexao.php';

echo "<h2>Autores</h2>";
echo "<a href='cadastrar_autor.php'>Cadastrar Novo Autor</a><br><br>";

$sql = "SELECT * FROM autores";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "Nome: " . $row['nome'] . 
         " <a href='excluir_autor.php?id={$row['id']}' onclick=\"return confirm('Excluir autor?')\">Excluir</a><br>";
}
?>

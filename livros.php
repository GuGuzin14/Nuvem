<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
include 'conexao.php';

$sql = "SELECT livros.id, livros.titulo, livros.ano_publicacao, autores.nome AS autor 
        FROM livros 
        INNER JOIN autores ON livros.id_autor = autores.id";

$result = $conn->query($sql);

echo "<h2>Livros</h2>";
echo "<a href='cadastrar_livro.php'>Cadastrar Novo Livro</a><br><br>";

while($row = $result->fetch_assoc()) {
    echo "Título: " . $row['titulo'] . " | Autor: " . $row['autor'] . 
         " | Ano: " . $row['ano_publicacao'] .
         " <a href='editar_livro.php?id={$row['id']}'>Editar</a> | 
           <a href='excluir_livro.php?id={$row['id']}' onclick=\"return confirm('Excluir livro?')\">Excluir</a><br>";
}
?>

<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
include 'conexao.php';

$sql = "SELECT livros.id, livros.titulo, livros.ano_publicacao, autores.nome AS autor 
        FROM livros 
        INNER JOIN autores ON livros.id_autor = autores.id
        ORDER BY livros.titulo";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livros</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .actions a { margin-right: 10px; }
        .top-bar { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; }
        .top-bar h2 { margin:0; }
        .btn-small { padding:8px 14px; font-size:14px; display:inline-block; background:#3498db; color:#fff; border-radius:6px; }
        .btn-small:hover { background:#21618c; }
        table a { color:#3498db; }
    </style>
</head>
<body>
<div class="container">
    <div class="nav">
        <a href="painel.php">Painel</a>
        <a href="autores.php">Autores</a>
        <a href="cadastrar_livro.php">Novo Livro</a>
        <a href="logout.php">Sair</a>
    </div>

    <div class="top-bar">
        <h2>Livros</h2>
        <a class="btn-small" href="cadastrar_livro.php">Cadastrar Livro</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th style="width:170px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($row['autor']); ?></td>
                        <td><?php echo htmlspecialchars($row['ano_publicacao']); ?></td>
                        <td class="actions">
                            <a href="editar_livro.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="excluir_livro.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Excluir livro?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum livro cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

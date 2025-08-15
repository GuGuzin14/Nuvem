<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
include 'conexao.php';

$sql = "SELECT * FROM autores ORDER BY nome";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .actions a { margin-right: 8px; }
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
        <a href="livros.php">Livros</a>
        <a href="cadastrar_autor.php">Novo Autor</a>
        <a href="logout.php">Sair</a>
    </div>

    <div class="top-bar">
        <h2>Autores</h2>
        <a class="btn-small" href="cadastrar_autor.php">Cadastrar Autor</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th style="width:140px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td class="actions">
                            <a href="excluir_autor.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Excluir autor?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2">Nenhum autor cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

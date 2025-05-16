<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
include 'conexao.php';

// Se for atualização (POST)
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $id_autor = $_POST['id_autor'];
    $ano = $_POST['ano_publicacao'];

    $sql = "UPDATE livros SET titulo='$titulo', id_autor='$id_autor', ano_publicacao='$ano' WHERE id=$id";
    if($conn->query($sql)) {
        header("Location: livros.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
} else {
    // Se for carregamento de edição (GET)
    if(!isset($_GET['id'])) {
        echo "ID do livro não informado.";
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM livros WHERE id=$id";
    $result = $conn->query($sql);

    if($result->num_rows == 0) {
        echo "Livro não encontrado.";
        exit;
    }

    $livro = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Livro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Editar Livro</h2>
    <form action="editar_livro.php" method="POST" onsubmit="return validarFormulario()">
        <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">

        Título: <input type="text" name="titulo" id="titulo" value="<?php echo $livro['titulo']; ?>"><br>

        Autor:
        <select name="id_autor">
            <?php
            $res = $conn->query("SELECT * FROM autores");
            while($autor = $res->fetch_assoc()) {
                $selected = $autor['id'] == $livro['id_autor'] ? "selected" : "";
                echo "<option value='{$autor['id']}' $selected>{$autor['nome']}</option>";
            }
            ?>
        </select><br>

        Ano de Publicação: <input type="number" name="ano_publicacao" value="<?php echo $livro['ano_publicacao']; ?>"><br>

        <input type="submit" value="Atualizar">
    </form>

    <br><a href="livros.php">Voltar</a>
</div>

<script>
function validarFormulario() {
    var titulo = document.getElementById('titulo').value;
    if(titulo.trim() === "") {
        alert("Informe o título do livro.");
        return false;
    }
    return true;
}
</script>
</body>
</html>

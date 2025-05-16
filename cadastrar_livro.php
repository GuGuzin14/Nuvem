<head><link rel="stylesheet" href="assets/style.css"></head>
<form action="cadastrar_livro.php" method="POST" onsubmit="return validarFormulario()">
    Título: <input type="text" name="titulo" id="titulo"><br>
    Autor:
    <select name="id_autor">
        <?php
        include 'conexao.php';
        $res = $conn->query("SELECT * FROM autores");
        while($autor = $res->fetch_assoc()) {
            echo "<option value='{$autor['id']}'>{$autor['nome']}</option>";
        }
        ?>
    </select><br>
    Ano de Publicação: <input type="number" name="ano_publicacao"><br>
    <input type="submit" value="Cadastrar">
</form>

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

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';
    $titulo = $_POST['titulo'];
    $id_autor = $_POST['id_autor'];
    $ano = $_POST['ano_publicacao'];

    $sql = "INSERT INTO livros (titulo, id_autor, ano_publicacao) VALUES ('$titulo', '$id_autor', '$ano')";
    if($conn->query($sql)) {
        header("Location: livros.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>


<head><link rel="stylesheet" href="style.css"></head>
<form action="cadastrar_autor.php" method="POST" onsubmit="return validarFormulario()">
    Nome do Autor: <input type="text" name="nome" id="nome"><br>
    <input type="submit" value="Cadastrar">
</form>

<script>
function validarFormulario() {
    var nome = document.getElementById('nome').value;
    if(nome.trim() === "") {
        alert("Informe o nome do autor.");
        return false;
    }
    return true;
}
</script>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';
    $nome = $_POST['nome'];

    $sql = "INSERT INTO autores (nome) VALUES ('$nome')";
    if($conn->query($sql)) {
        header("Location: autores.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

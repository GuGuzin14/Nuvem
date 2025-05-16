<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Cadastrar Novo Administrador</h2>
    <form action="cadastrar_admin.php" method="POST" onsubmit="return validarFormulario()">
        Usuário: <input type="text" name="usuario" id="usuario"><br>
        Senha: <input type="password" name="senha" id="senha"><br>
        <input type="submit" value="Cadastrar">
</form>
</div>

<script>
function validarFormulario() {
    var usuario = document.getElementById('usuario').value;
    var senha = document.getElementById('senha').value;

    if (usuario.trim() === "" || senha.trim() === "") {
        alert("Preencha todos os campos.");
        return false;
    }
    return true;
}
</script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário já existe
    $verifica = $conn->query("SELECT * FROM administradores WHERE usuario = '$usuario'");
    if($verifica->num_rows > 0) {
        echo "<script>alert('Usuário já existe. Escolha outro.');</script>";
    } else {
        $sql = "INSERT INTO administradores (usuario, senha) VALUES ('$usuario', '$senha')";
        if($conn->query($sql)) {
            echo "<script>alert('Administrador cadastrado com sucesso!'); window.location='painel.php';</script>";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

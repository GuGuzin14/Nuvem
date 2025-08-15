<?php
session_start();
include 'conexao.php';
// Página aberta: não exige login para criar admin (atenção: risco de segurança em produção)
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
        Usuário: <input type="text" name="usuario" id="usuario" required><br>
        Senha: <input type="password" name="senha" id="senha" required><br>
        <input type="submit" value="Cadastrar">
    <br><br>
    <?php if(isset($_SESSION['logado'])) { echo '<a href="painel.php">Voltar</a>'; } else { echo '<a href="login.php">Voltar ao Login</a>'; } ?>
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
    // Sanitiza entradas básicas
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($usuario === '' || $senha === '') {
        echo "<script>alert('Preencha todos os campos.');</script>";
    } else {
        // Verifica se já existe usuário com prepared statement
        $stmt = $conn->prepare("SELECT id FROM administradores WHERE usuario = ? LIMIT 1");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Usuário já existe. Escolha outro.');</script>";
        } else {
            // Usa md5 para manter compatibilidade (recomendado migrar para password_hash futuramente)
            $hash = md5($senha);
            $ins = $conn->prepare("INSERT INTO administradores (usuario, senha) VALUES (?, ?)");
            $ins->bind_param('ss', $usuario, $hash);
            if($ins->execute()) {
                echo "<script>alert('Administrador cadastrado com sucesso!'); window.location='login.php?msg=admin_ok';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar: " . addslashes($conn->error) . "');</script>";
            }
            $ins->close();
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if(isset($_GET['msg']) && $_GET['msg']==='precisa_logar') { echo '<p style="color:#c00;">Faça login para continuar.</p>'; } ?>
    <?php if(isset($_GET['msg']) && $_GET['msg']==='admin_ok') { echo '<p style="color:green;">Administrador cadastrado. Faça login.</p>'; } ?>
    <?php if(isset($_GET['erro']) && $_GET['erro']==='1') { echo '<p style="color:#c00;">Usuário ou senha inválidos.</p>'; } ?>
    <form action="validar_login.php" method="POST">
        Usuário: <input type="text" name="usuario" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Entrar">
        <button type="button" onclick="window.location='cadastrar_admin.php'">Cadastrar Admin</button>
    </form>
</div>
</body>
</html>

<?php
require_once('config.php');

// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Busca o usuário na tabela "users"
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifica se a senha está correta
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: ../index.php');
        } else {
            $error = "Senha incorreta.";
        }
    } else {
        $error = "Nome de usuário não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <h1>Login de Usuário</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Nome de Usuário:</label>
        <input type="text" name="username" required><br>
        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Entrar</button>
    </form>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

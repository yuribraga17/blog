<?php
require_once('config.php');


// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifica se o nome de usuário já está em uso
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error = "O nome de usuário já está em uso. Tente outro nome.";
    } else {
        // Insere os dados do usuário na tabela "users"
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['username'] = $username;
            header('Location: ../index.php');
        } else {
            $error = "Erro ao registrar usuário: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuário</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
    <h1>Registro de Usuário</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Nome de Usuário:</label>
        <input type="text" name="username" required><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br>
        <label for="password">Senha:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Registrar</button>
    </form>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'config.php';

    // Inicia a sessão
    session_start();

    // Verifica se o usuário está logado
    if (isset($_SESSION['id'])) {
        // Se estiver logado, redireciona para a página de dashboard
        header('Location: dashboard.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Blog</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <h1>Meu Blog</h1>
        <nav>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="paginas/sobre.html">Sobre</a></li>
                <li><a href="paginas/contato.html">Contato</a></li>
                <li><a href="paginas/postar.php">Postar</a></li>
                <li><a href="paginas/sair.php">Sair</a></li>
                <li><a href="paginas/dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Bem-vindo ao Meu Blog</h2>
        <p>Este é um site de blog onde você pode encontrar artigos sobre diversos temas.</p>
        <a href="paginas/login.php">Fazer login</a>
        <a href="paginas/registro.php">Criar uma conta</a>
    </main>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estatísticas do site</title>
    <link rel="stylesheet" type="text/css" href="css/painel.css">
</head>
<body>
    <h1>Estatísticas do site</h1>
    <table>
        <tr>
            <th>Total de usuários registrados</th>
            <th>Total de publicações</th>
        </tr>
        <?php
            require_once('config.php');
            require_once('funcoes.php');
    
            session_start();

            // Verifica se o usuário está logado
            if(!is_logged_in()) {
                header('Location: login.php');
                exit();
            }        

            // Obtém o total de usuários registrados
            $stmt = $pdo->query('SELECT COUNT(*) FROM users');
            $total_users = $stmt->fetchColumn();

            // Obtém o total de publicações
            $stmt = $pdo->query('SELECT COUNT(*) FROM posts');
            $total_posts = $stmt->fetchColumn();

            // Exibe as estatísticas em uma tabela
            echo '<tr>';
            echo '<td>' . $total_users . '</td>';
            echo '<td>' . $total_posts . '</td>';
            echo '</tr>';
        ?>
    </table>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas publicações</title>
    <link rel="stylesheet" type="text/css" href="css/ver.css">
</head>
<body>
    <h1>Minhas publicações</h1>
    <a id="logout" href="sair.php">Sair</a>
    <table>
        <tr>
            <th>Título</th>
            <th>Conteúdo</th>
            <th>Arquivo</th>
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

            // Obtém as publicações do usuário
            $user_id = $_SESSION['user_id'];
            $stmt = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC');
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Exibe as publicações em uma tabela
            foreach($posts as $post) {
                echo '<tr>';
                echo '<td>' . $post['title'] . '</td>';
                echo '<td>' . $post['content'] . '</td>';
                if($post['file_path'] != '') {
                    echo '<td><a href="' . $post['file_path'] . '">Arquivo</a></td>';
                } else {
                    echo '<td></td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
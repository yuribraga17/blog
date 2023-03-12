<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo post</title>
    <link rel="stylesheet" href="css/post.css">
</head>
<body>
    <h1>Novo post</h1>
    <form action="new_post.php" method="post" enctype="multipart/form-data">
        <label for="title">Título:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Conteúdo:</label><br>
        <textarea id="content" name="content"></textarea><br>
        <label for="file">Arquivo:</label><br>
        <input type="file" id="file" name="file"><br><br>
        <input type="submit" name="submit" value="Salvar">
    </form>
    <footer>
        <p>&copy; Desenvolvido por <a href="https://github.com/yuribraga17">Yuri Braga</a>. Todos os direitos reservados.</p>
    </footer>
</body>
</html>

<?php
require_once('config.php');
require_once('funcoes.php');

session_start();

// Verifica se o usuário está logado
if(!is_logged_in()) {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário foi submetido
if(isset($_POST['submit'])) {

    // Obtém os dados do formulário
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Verifica se foi selecionado um arquivo para upload
    if(isset($_FILES['file']) && $_FILES['file']['name'] != '') {
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES['file']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verifica se o arquivo é uma imagem ou um vídeo
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' && $imageFileType != 'mp4' && $imageFileType != 'webm') {
            echo 'O arquivo deve ser uma imagem ou um vídeo.';
            $uploadOk = 0;
        }

        // Verifica se o arquivo já existe
        if(file_exists($target_file)) {
            echo 'Desculpe, o arquivo já existe.';
            $uploadOk = 0;
        }

        // Verifica o tamanho do arquivo
        if($_FILES['file']['size'] > 5000000) {
            echo 'Desculpe, o arquivo é muito grande.';
            $uploadOk = 0;
        }

        // Faz o upload do arquivo
        if($uploadOk == 1) {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                $file_path = $target_file;
            } else {
                echo 'Desculpe, houve um erro ao fazer o upload do arquivo.';
            }
        }
    } else {
        $file_path = '';
    }

    // Insere o post no banco de dados
    $stmt = $pdo->prepare('INSERT INTO posts (title, content, file_path, user_id) VALUES (:title, :content, :file_path, :user_id)');
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':file_path', $file_path);
    $stmt->bindValue(':user_id', $user_id);
    if($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Desculpe, houve um erro ao salvar o post no banco de dados.';
    }
}    
?>

<?php
    if (is_logged_in()) {
        // código que apenas usuários autenticados podem acessar
    } else {
        // redireciona para a página de login
        header('Location: ../paginas/login.php');
        exit;
    }
?>
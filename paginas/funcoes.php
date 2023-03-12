<?php
    function is_logged_in() {
        return isset($_SESSION['user_id']);
    }
?>
<?php
    require_once('config.php');
    require_once('funcoes.php');
    
    session_start();

    // Verifica se o usuário está logado
    if(!is_logged_in()) {
        header('Location: login.php');
        exit();
    }

    // Restante do código
?>



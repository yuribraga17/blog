<?php
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Se o usuário estiver logado, destrua a sessão
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Finalmente, destrói a sessão
session_destroy();

// Redirecionar para a página de login
header("Location: login.php");
exit;
?>

<?php
session_start();

// Encerra todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona para a tela de login
header("Location: login.php");
exit;
?>

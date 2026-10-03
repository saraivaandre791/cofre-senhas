<?php
session_start();

// Se já estiver autenticado, redireciona para a página principal
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="w3schools.css">

    <meta charset="UTF-8">
    <title>Cofre de Senhas — Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 0.7rem;
            margin: 0.5rem 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body class="w3-black">
    <div class="login-box">
        <h2>Senha-mestra</h2>
        <form action="valida_login.php" method="POST">
            <input type="password" name="senha_mestra" placeholder="Digite sua senha" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>

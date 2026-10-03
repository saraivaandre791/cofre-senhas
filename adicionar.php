<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel ="stylesheet" href="w3schools.css">

    <meta charset="UTF-8">
    <title>Adicionar Credencial</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 2rem; }
        form { background: #fff; padding: 2rem; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 0.7rem; margin: 0.5rem 0; border-radius: 5px; border: 1px solid #ccc; }
        input[type="submit"] { background: #007BFF; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #0056b3; }
    </style>
</head>
<body class="w3-black">
    <h2 style="text-align:center">Nova Credencial</h2>
    <form action="salvar.php" method="POST">
        <input type="text" name="servico" placeholder="Serviço (ex: Gmail)" required>
        <input type="text" name="usuario" placeholder="Usuário/Login" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <select name="tipo">
            <option value="login">Login</option>
            <option value="cartao">Cartão</option>
        </select>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>

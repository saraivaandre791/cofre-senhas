<?php

session_start();
include("conexao.php");

// Recebe a senha digitada
$senha_digitada = $_POST['senha_mestra'] ?? '';

// Busca o hash armazenado no banco
$sql = "SELECT senha_hash FROM usuarios LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    $usuario = mysqli_fetch_assoc($result);
    $senha_hash = $usuario['senha_hash'];

    // Valida a senha usando password_verify
    if (password_verify($senha_digitada, $senha_hash)) {

        session_regenerate_id(true);

        $_SESSION['autenticado'] = true;

        header("Location: index.php");
        exit;

    } else {

        $_SESSION['erro_login'] = "Senha incorreta!";
        header("Location: login.php");
        exit;

    }

} else {

    die("Nenhum usuário cadastrado no sistema.");

}
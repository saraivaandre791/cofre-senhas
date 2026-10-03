<?php
session_start();
include("conexao.php");
include("config.php");

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}

$id      = $_POST['id'] ?? 0;
$servico = $_POST['servico'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$senha   = $_POST['senha'] ?? '';
$tipo    = $_POST['tipo'] ?? 'login';

// Chave secreta (mesma usada em salvar.php e index.php)
$senhaCriptografada = openssl_encrypt(
$senha,
"AES-128-ECB",
CHAVE_CRIPTOGRAFIA
);

// Atualiza no banco
$sql = "UPDATE credenciais SET servico=?, usuario=?, senha_criptografada=?, tipo=? WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $servico, $usuario, $senhaCriptografada, $tipo, $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao atualizar credencial: " . mysqli_error($conn);
}
?>

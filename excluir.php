<?php
session_start();
include("conexao.php");
include("config.php");

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    $sql = "DELETE FROM credenciais WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php"); // volta para a lista
        exit;
    } else {
        echo "Erro ao excluir credencial: " . mysqli_error($conn);
    }
} else {
    echo "ID inválido.";
}
?>

<?php
session_start();
include("conexao.php");
include("config.php");

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM credenciais WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$credencial = mysqli_fetch_assoc($result);

if (!$credencial) {
    echo "Credencial não encontrada.";
    exit;
}

// Chave secreta (mesma usada em salvar.php e index.php)
$senhaCriptografada = openssl_encrypt(
$senha,
"AES-128-ECB",
CHAVE_CRIPTOGRAFIA
);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="w3schools.css">

    <meta charset="UTF-8">
    <title>Editar Credencial</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 2rem; }
        form { background: #fff; padding: 2rem; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 0.7rem; margin: 0.5rem 0; border-radius: 5px; border: 1px solid #ccc; }
        input[type="submit"] { background: #007BFF; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #0056b3; }
    </style>
</head>
<body class="w3-black">
    <h2 style="text-align:center">Editar Credencial</h2>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $credencial['id']; ?>">
        <input type="text" name="servico" value="<?php echo htmlspecialchars($credencial['servico']); ?>" required>
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($credencial['usuario']); ?>" required>
        <input type="password" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required>
        <select name="tipo">
            <option value="login" <?php if($credencial['tipo']=="login") echo "selected"; ?>>Login</option>
            <option value="cartao" <?php if($credencial['tipo']=="cartao") echo "selected"; ?>>Cartão</option>
        </select>
        <input type="submit" value="Atualizar">
    </form>
</body>
</html>

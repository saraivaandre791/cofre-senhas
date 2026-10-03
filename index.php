<?php
session_start();
include("conexao.php");
include("config.php");

// Se não estiver autenticado, volta para login
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}

// Consulta as credenciais
$sql = "SELECT id, servico, usuario, senha_criptografada, tipo FROM credenciais";
$result = mysqli_query($conn, $sql);

// Chave usada para criptografia (mesma usada em salvar.php)

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="w3schools.css">

    <meta charset="UTF-8">
    <title>Cofre de Senhas — Principal</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 2rem; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ccc; padding: 0.7rem; text-align: left; }
        th { background: #007BFF; color: #fff; }
        a { text-decoration: none; color: #007BFF; }
        .actions { margin-top: 1rem; }
    </style>
</head>
<body class="w3-black">
    <h2>Minhas Credenciais</h2>

    <table>
        <tr>
            <th>Serviço</th>
            <th>Usuário</th>
            <th>Senha</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                $senha = openssl_decrypt(
                    $row['senha_criptografada'],
                    "AES-128-ECB",
                    CHAVE_CRIPTOGRAFIA
                );
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['servico']); ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($senha); ?></td>
                    <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-editar">Editar</a> | 
                        <a href="excluir.php?id=<?php echo $row['id']; ?>" class="btn btn-excluir">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhuma credencial cadastrada.</td></tr>
        <?php endif; ?>
    </table>

    <div class="actions">
        <a href="adicionar.php" class="btn btn-adicionar">Adicionar</a> | 
        <a href="logout.php" class="btn btn-sair">Sair</a>
    </div>
</body>
</html>

<?php
session_start();
include("conexao.php");
include("config.php");

// 1. VALIDAÇÃO DE ACESSO: Garante que só usuários logados acessam este arquivo
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php");
    exit;
}

// 2. RECEBIMENTO DOS DADOS: O uso da função trim() remove espaços vazios acidentais ou maliciosos
$servico = trim($_POST['servico'] ?? '');
$usuario = trim($_POST['usuario'] ?? '');
$senha   = trim($_POST['senha'] ?? '');
$tipo    = trim($_POST['tipo'] ?? 'login');

// 3. UPGRADE DE QA (Validação de Back-end): Se qualquer campo obrigatório estiver vazio, barra o salvamento
if (empty($servico) || empty($usuario) || empty($senha)) {
    // Guarda a mensagem de erro na sessão para poder exibir no front-end depois se quiser
    $_SESSION['erro_cadastro'] = "Erro: Todos os campos são obrigatórios!";
    
    // Redireciona o usuário (ou o Postman) de volta para o formulário
    header("Location: adicionar.php");
    exit;
}

// 4. SEGURANÇA DOS DADOS: Chave secreta e processo de criptografia
$senhaCriptografada = openssl_encrypt(
$senha,
"AES-128-ECB",
CHAVE_CRIPTOGRAFIA
);

// 5. BANCO DE DADOS: Inserção segura usando Prepared Statements (Código que você já havia feito com maestria)
$sql = "INSERT INTO credenciais (servico, usuario, senha_criptografada, tipo) 
        VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $servico, $usuario, $senhaCriptografada, $tipo);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php"); // Se der certo, volta para a lista principal
    exit;
} else {
    echo "Erro ao salvar credencial: " . mysqli_error($conn);
}
?>

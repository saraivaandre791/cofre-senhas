<?php
// Configurações do servidor local (XAMPP)
$servidor = "localhost";     // Host MySQL local
$usuario  = "root";          // Usuário padrão do XAMPP
$senha    = "";              // Senha padrão (normalmente vazia no XAMPP)
$banco    = "cofre_senhas";  // Nome do banco que você criou

// Cria a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se a conexão foi bem-sucedida
if(!$conn){
    die("Falha na conexão: " . mysqli_connect_error());
}

// Força o uso de UTF-8 para evitar problemas com acentos
mysqli_set_charset($conn, "utf8mb4");

?>
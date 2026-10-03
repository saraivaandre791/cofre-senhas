Cofre de Senhas
Sistema web desenvolvido em PHP e MySQL para armazenamento seguro de credenciais através de autenticação por senha mestra.

Funcionalidades
Login utilizando senha mestra
Cadastro de credenciais
Edição de credenciais
Exclusão de credenciais
Proteção de acesso por sessão
Armazenamento criptografado das senhas
Tecnologias Utilizadas
PHP
MySQL
HTML5
CSS3
XAMPP
Estrutura do Projeto
cofre_senhas/
│
├── adicionar.php
├── atualizar.php
├── conexao.php
├── config.example.php
├── editar.php
├── excluir.php
├── index.php
├── login.php
├── logout.php
├── salvar.php
├── valida_login.php
├── style.css
├── w3schools.css
│
└── data_base/
    └── criar_bd.sql
Instalação
1. Clone o projeto
git clone https://github.com/saraivaandre791/cofre-senhas.git
2. Configure o banco de dados
Importe o arquivo:

data_base/criar_bd.sql
3. Configure a chave de criptografia
Crie um arquivo chamado:

config.php
a partir de:

config.example.php
Edite a constante:

define('CHAVE_CRIPTOGRAFIA', 'SUA_CHAVE_AQUI');
4. Configure a senha mestra
Crie um hash da senha usando:

password_hash("SUA_SENHA", PASSWORD_DEFAULT);
Insira o hash na tabela:

usuarios
5. Execute o projeto
Inicie Apache e MySQL pelo XAMPP e acesse:

http://localhost/cofre_senhas
Segurança
Senha mestra protegida com password_hash() e password_verify()
Credenciais armazenadas de forma criptografada
Controle de acesso por sessão
Chave de criptografia separada do código-fonte
Autor
André Saraiva Batista

Licença
Projeto desenvolvido para fins de estudo e portfólio.
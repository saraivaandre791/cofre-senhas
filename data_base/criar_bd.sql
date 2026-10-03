use cofre_senhas;
create table credenciais (
id int auto_increment primary key,
servico varchar(100) not null,
usuario varchar(100) not null,
senha_criptografada text not null,
tipo enum('login', 'cartao') default 'login'
);

create table usuarios(
	 id INT AUTO_INCREMENT PRIMARY KEY,
     senha_hash VARCHAR(255) NOT NULL
     );
    
    INSERT INTO usuarios (senha_hash)
    VALUES('$2y$10$OjRDk7.ip16hQWbRUnMWDO7ElYFJ3NqzTlfnSzjc/WUEpACz4yw0i');

select * from credenciais;
select * from usuarios;

delete from usuarios;




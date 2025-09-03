create database meuBancoDeDados;
use meuBancoDeDados;

create table tb_contato (
id int primary key auto_increment,
nome varchar(50) not null,
login varchar(20) not null,
senha char(8) not null,
email varchar(250) not null,
telefone varchar(17) not null,
foto varchar(250) null
);

Insert into tb_contato values (null, 'administrador', 'admin', '@Admin01', 'admin@gmail.com', '11111111111', 'https://cdn-icons-png.freepik.com/512/64/64572.png');

SELECT * FROM tb_contato;

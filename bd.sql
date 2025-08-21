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

SELECT * FROM tb_contato;

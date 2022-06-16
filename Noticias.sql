create database noticias;
use noticias;
create table noticia (
	id integer primary key auto_increment COMMENT 'Identificador sequencial único da notícia.',
	uniqid VARCHAR(255) COMMENT 'Identificador aleatório único da notícia.',
	title VARCHAR(45) COMMENT 'Título da notícia.',
	description BLOB COMMENT 'Conteúdo/descrição da notícia.',
	image VARCHAR(45) COMMENT 'Endereço da imagem da notícia.'
) COMMENT='Tabela de notícias.';

CREATE TABLE tk_api (
	id integer primary key auto_increment COMMENT 'Identificador sequencial único do token.',
    token varchar(255) COMMENT 'Valor do token.',
    isValid boolean COMMENT '0 para inválido, 1 para válido.'
) COMMENT='Tabela dos tokens de acesso à API.';
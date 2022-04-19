drop table if exists estoque ;
CREATE TABLE estoque (
  id_estoque int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto int(11) DEFAULT NULL,
  quantidade int(6) DEFAULT NULL,
  lote varchar(120) DEFAULT NULL,
  validade timestamp NULL DEFAULT NULL,
  data_atualizar timestamp NULL DEFAULT NULL
);

drop table if exists produto;
CREATE TABLE produto (
  id_produto int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_fornecedor int(11) DEFAULT NULL,
  id_categoria int(11) DEFAULT NULL,
  nome varchar(100) DEFAULT NULL,
  data_criar timestamp NULL DEFAULT NULL,
  data_atualizar timestamp NULL DEFAULT NULL
) ; 

drop table if exists categoria;
CREATE TABLE categoria(  
    id_categoria int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(100) unique,
	ativo int(1) default 1,
    data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
) ;

drop table if exists log;
CREATE TABLE log(  
    id_log int(11) NOT NULL primary key AUTO_INCREMENT,
    id_usuario int(11),
    id_produto int(11),
    tipo varchar(12),
    antigo varchar(100),
    atual varchar(100),
	data_criar TIMESTAMP
) ; 

drop table if exists ean;
CREATE TABLE ean(  
    id_ean int(11) NOT NULL primary key AUTO_INCREMENT,
	id_produto int(11),
    ean varchar(100) unique,
	data_criar TIMESTAMP,
    data_atualizar timestamp NULL DEFAULT NULL
) ; 

drop table if exists funcionario;
CREATE TABLE funcionario(  
    id_funcionario int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120),
    cpf varchar(120) UNIQUE,
    telefone varchar(120),
    email varchar(120),
    matricula varchar(80),
    usuario varchar(80) unique,
    senha varchar(80),
    id_nivel int(11),
    ativo int(1),
    trocasenha int(1),
	data_criar TIMESTAMP,
    data_atualizar timestamp NULL DEFAULT NULL
); 

drop table if exists nivel;
CREATE TABLE nivel(  
    id_nivel int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120) unique,
    painel varchar(1),
    cliente varchar(1),
    nivel varchar(1),
    caixa varchar(1),
    venda varchar(1),
    estoque varchar(1),
    produto varchar(1),
    usuario varchar(1),
    categoria varchar(1),
    fornecedor varchar(1),
    empresa varchar(1),
	sangria varchar(1),
	excluir_item varchar(1),
	relatorio varchar(1),
    desconto varchar(1),
    valor_desconto DECIMAL(4,2) DEFAULT 0.00,    
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
);

drop table if exists fornecedor;
CREATE TABLE fornecedor(  
    id_fornecedor int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120),
    cnpj varchar(22) unique,
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
);

drop table if exists valor_venda;
CREATE TABLE valor_venda (
  id_valor int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto int(11) NOT NULL,
  valor_venda decimal(10,2) DEFAULT '0.00',
  valor_compra decimal(10,2) DEFAULT '0.00',
  valor_atual smallint DEFAULT '1',
  data_atualizar timestamp NULL DEFAULT NULL
) ;

drop table if exists venda;
CREATE TABLE venda (
  id_venda int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto int(11) NOT NULL,
  id_usuario int(11),
  id_cliente int(11),
  venda varchar(40),
  valor_venda decimal(10,2) DEFAULT '0.00',
  quantidade int(11) default 0,
  data_venda timestamp NULL DEFAULT NULL
) ;

drop table if exists cliente;
CREATE TABLE cliente (
  id_cliente int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome varchar(40),
  cpf varchar(14),
  rua varchar(200),
  bairro varchar(200),
  cidade varchar(200),
  UF varchar(2),
  limite decimal(10,2) DEFAULT '0.00',  
  ativo int(1) default 1,
  data_criar timestamp NULL DEFAULT NULL
) ;


drop view if exists visao_estoque;
CREATE VIEW  visao_estoque
AS
SELECT 
F.nome as fornecedor,E.id_estoque ,P.id_produto,P.nome as nome, P.id_categoria, C.nome as categoria, E.lote,E.quantidade 
FROM 
estoque E INNER JOIN  produto P ON E.id_produto=P.id_produto INNER JOIN fornecedor F on P.id_fornecedor=F.id_fornecedor
INNER JOIN categoria C on P.id_categoria=C.id_categoria;

drop trigger if exists TR_ESTOQUE;
CREATE DEFINER =`root`@`localhost` 
TRIGGER TR_ESTOQUE AFTER INSERT ON produto FOR EACH ROW
insert into estoque(id_produto,quantidade) value (NEW.id_produto, 0);

insert into fornecedor values (null,'PADRÃO','00.000.000/0000-00',NOW(),null);





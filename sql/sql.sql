drop table if exists estoque ;
CREATE TABLE estoque (
  id_estoque int NOT NULL AUTO_INCREMENT,
  id_produto int DEFAULT NULL,
  quantidade int DEFAULT NULL,
  lote varchar(120) DEFAULT NULL,
  validade timestamp NULL DEFAULT NULL,
  data_atualizar timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id_estoque)
)

drop table if exists produto;
CREATE TABLE produto (
  id_produto int NOT NULL AUTO_INCREMENT,
  id_fornecedor int DEFAULT NULL,
  id_categoria int DEFAULT NULL,
  nome varchar(100) DEFAULT NULL,
  data_criar timestamp NULL DEFAULT NULL,
  data_atualizar timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id_produto)
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
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
) ; 

drop table if exists ean;
CREATE TABLE ean(  
    id_ean int(11) NOT NULL primary key AUTO_INCREMENT,
	id_produto int(11),
    ean varchar(100) unique,
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
) ; 

drop table if exists usuario;
CREATE TABLE usuario(  
    id_usuario int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120),
    login varchar(80) unique,
    senha varchar(80),
    id_nivel int(11),
    ativo int(1),
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
); 

drop table if exists nivel;
CREATE TABLE nivel(  
    id_nivel int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120) unique,
    vendedor varchar(1),
    estoquista varchar(1),
    gerente varchar(1),
    administrador varchar(1),
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
);

drop table if exists fornecedor;
CREATE TABLE fornecedor(  
    id_fornecedor int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120),
    cnpj varchar(22) unique,
	data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
);
drop table if exists valor_venda;
CREATE TABLE valor_venda (
  id_valor int NOT NULL AUTO_INCREMENT,
  id_produto int NOT NULL,
  valor_venda decimal(10,2) DEFAULT '0.00',
  valor_compra decimal(10,2) DEFAULT '0.00',
  valor_atual smallint DEFAULT '1',
  data_atualizar timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id_valor)
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
insert into estoque(id_produto,quantidade) value (NEW.id_produto, 0, 0.00, 0.00);

insert into fornecedor values (null,'PADRÃO','00.000.000/0000-00',NOW(),null);





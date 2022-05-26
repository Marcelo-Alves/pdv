DROP TABLE IF EXISTS estoque ;
CREATE TABLE estoque (
  id_estoque INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto INT(11) DEFAULT NULL,
  quantidade INT(6) DEFAULT NULL,
  lote VARCHAR(120) DEFAULT NULL,
  validade TIMESTAMP NULL DEFAULT NULL,
  data_atualizar TIMESTAMP NULL DEFAULT NULL
);

DROP TABLE IF EXISTS produto;
CREATE TABLE produto (
  id_produto INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_fornecedor INT(11) DEFAULT NULL,
  id_categoria INT(11) DEFAULT NULL,
  nome VARCHAR(150) DEFAULT NULL,
  data_criar TIMESTAMP NULL DEFAULT NULL,
  data_atualizar TIMESTAMP NULL DEFAULT NULL
) ; 

DROP TABLE IF EXISTS categoria;
CREATE TABLE categoria(  
    id_categoria INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) UNIQUE,
	ativo INT(1) DEFAULT 1,
    data_criar TIMESTAMP NULL DEFAULT NULL,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
) ;

DROP TABLE IF EXISTS log;
CREATE TABLE log(  
    id_log INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT(11),
    id_produto INT(11),
    tipo VARCHAR(12),
    antigo VARCHAR(150),
    atual VARCHAR(150),
	data_criar TIMESTAMP NULL DEFAULT NULL
) ; 

DROP TABLE IF EXISTS ean;
CREATE TABLE ean(  
    id_ean INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_produto INT(11),
    ean VARCHAR(100) UNIQUE,
	data_criar  TIMESTAMP NULL DEFAULT NULL,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
) ; 

DROP TABLE IF EXISTS funcionario;
CREATE TABLE funcionario(  
    id_funcionario INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120),
    cpf VARCHAR(120) UNIQUE,
    telefone VARCHAR(120),
    email VARCHAR(120),
    matricula VARCHAR(80),
    usuario VARCHAR(80) UNIQUE,
    senha VARCHAR(80),
    id_nivel INT(11),
    ativo INT(1),
    trocasenha INT(1),
	data_criar TIMESTAMP NULL DEFAULT NULL,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
); 

DROP TABLE IF EXISTS nivel;
CREATE TABLE nivel(  
    id_nivel INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120) UNIQUE,
    painel VARCHAR(1),
    cliente VARCHAR(1),
    nivel VARCHAR(1),
    caixa VARCHAR(1),
    venda VARCHAR(1),
    estoque VARCHAR(1),
    produto VARCHAR(1),
    ean VARCHAR(1),
    usuario VARCHAR(1),
    categoria VARCHAR(1),
    fornecedor VARCHAR(1),
    funcionario VARCHAR(1),
    empresa VARCHAR(1),
	sangria VARCHAR(1),
	excluir_item VARCHAR(1),
	relatorio VARCHAR(1),
    desconto VARCHAR(1),
    valor VARCHAR(1),
    valor_desconto DECIMAL(4,2) DEFAULT 0.00,    
	data_criar TIMESTAMP NULL DEFAULT NULL,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
);

DROP TABLE IF EXISTS fornecedor;
CREATE TABLE fornecedor(  
    id_fornecedor INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(120),
    cnpj VARCHAR(22) UNIQUE,
	data_criar TIMESTAMP NULL DEFAULT NULL,
    data_atualizar TIMESTAMP NULL DEFAULT NULL
);

DROP TABLE IF EXISTS valor_venda;
CREATE TABLE valor_venda (
  id_valor INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto INT(11) NOT NULL,
  valor_venda decimal(10,2) DEFAULT '0.00',
  valor_compra decimal(10,2) DEFAULT '0.00',
  valor_atual smallINT DEFAULT '1',
  data_atualizar TIMESTAMP NULL DEFAULT NULL
) ;

DROP TABLE IF EXISTS venda;
CREATE TABLE venda (
  id_venda INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto INT(11) NOT NULL,
  id_usuario INT(11),
  id_cliente INT(11),
  venda VARCHAR(40),
  valor_venda decimal(10,2) DEFAULT '0.00',
  quantidade INT(11) DEFAULT 0,
  data_venda TIMESTAMP NULL DEFAULT NULL
) ;

DROP TABLE IF EXISTS pedido_venda;
CREATE TABLE pedido_venda (
  id_venda INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_produto INT(11) NOT NULL,
  id_funcionario INT(11),
  id_cliente INT(11),
  venda VARCHAR(40),
  valor_venda decimal(10,2) DEFAULT '0.00',
  quantidade INT(11) DEFAULT 0,
  data_venda TIMESTAMP NULL DEFAULT NULL
) ;


DROP TABLE IF EXISTS cliente;
CREATE TABLE cliente (
  id_cliente INT(11)  PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome VARCHAR(140) DEFAULT NULL,
  telefone VARCHAR(14) DEFAULT NULL,
  email VARCHAR(100) DEFAULT NULL,
  cpf VARCHAR(14) UNIQUE DEFAULT NULL,
  cep VARCHAR(10) DEFAULT NULL,
  rua VARCHAR(200) DEFAULT NULL,
  numero VARCHAR(15) DEFAULT NULL,
  bairro VARCHAR(200) DEFAULT NULL,
  cidade VARCHAR(200) DEFAULT NULL,
  UF VARCHAR(2) DEFAULT NULL,
  limite decimal(10,2) DEFAULT '0.00',
  ativo INT(1) DEFAULT '1',
  data_criar TIMESTAMP NULL DEFAULT NULL,
  data_atualizar TIMESTAMP NULL DEFAULT NULL
);


DROP VIEW IF EXISTS visao_estoque;
CREATE VIEW  visao_estoque
AS
SELECT 
F.nome as fornecedor,E.id_estoque ,P.id_produto,P.nome as nome, P.id_categoria, C.nome as categoria, E.lote,E.quantidade,
V.valor_compra,V.valor_venda
FROM 
estoque E INNER JOIN  produto P ON E.id_produto=P.id_produto INNER JOIN fornecedor F on P.id_fornecedor=F.id_fornecedor
INNER JOIN categoria C on P.id_categoria=C.id_categoria
RIGHT JOIN valor_venda V on P.id_produto = V.id_produto
WHERE V.valor_atual=1;

DROP TRIGGER IF EXISTS TR_ESTOQUE;
CREATE DEFINER =`root`@`localhost` 
TRIGGER TR_ESTOQUE AFTER INSERT ON produto FOR EACH ROW
INSERT INTo estoque(id_produto,quantidade) VALUES (NEW.id_produto, 0);

DROP TRIGGER IF EXISTS TR_VALOR_VENDA;
CREATE DEFINER =`root`@`localhost` 
TRIGGER TR_VALOR_VENDA AFTER INSERT ON produto FOR EACH ROW
INSERT INTO valor_venda(id_produto,valor_compra,valor_venda,valor_atual) VALUES (NEW.id_produto, 0,0,1);

insert INTO fornecedor VALUES 
(NULL,'PADRÃO','00.000.000/0000-00',NOW(),NULL);
INSERT INTO nivel VALUES 
(NULL,'MASTER','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','10.00',NOW(),NULL);
INSERT INTO funcionario VALUES 
(NULL,'MARCELO ALVES MOREIRA','165.087.288-73','(11)98987-2622','mamdria@gmail.com','5598','5598','indios',1,1,1,NOW(),NULL);
INSERT INTO categoria VALUES (1,'ALIMENTICIOS',1,'2022-04-05 23:51:24',NULL);
INSERT INTO cliente VALUES 
(1,'PADRÃO','(11)11111-1111','padrao@padrao.com','111.111.111-11','00.000-000','RUA PADRÃO','000','PADRÃO','PADRÃO','SP',100.00,1,NOW(),NULL);
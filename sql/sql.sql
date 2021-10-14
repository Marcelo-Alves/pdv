drop table if exists estoque ;
CREATE TABLE estoque(  
    id_estoque int(11) NOT NULL primary key AUTO_INCREMENT,
    id_produto int(11),
    quantidade int(11),
    lote VARCHAR(120),
    data_atualizar TIMESTAMP
) ;

drop table if exists produto;
CREATE TABLE produto(  
    id_produto int(11) NOT NULL primary key AUTO_INCREMENT,
	id_fornecedor int(11),
	id_categoria int(11),
    nome varchar(100),
    validade int(1),
    validade_dias int(5),    
    qtde int(11),    
    data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
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
insert into fornecedor values (null,'PADRÃO','00.000.000/0000-00',NOW(),null);





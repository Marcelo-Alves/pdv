CREATE TABLE estoque(  
    id_estoque int(11) NOT NULL primary key AUTO_INCREMENT,
    id_produto int(11),
    quantidade int(11),
    lote VARCHAR(120),
    data_atualizar TIMESTAMP
) ;

CREATE TABLE produto(  
    id_produto int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(100),
    id_ean int(11),
    validade int(1),
    validade_dias int(5),    
    qtde int(11),    
    data_criar TIMESTAMP,
    data_atualizar TIMESTAMP
) ; 

CREATE TABLE log(  
    id_log int(11) NOT NULL primary key AUTO_INCREMENT,
    id_usuario int(11),
    id_produto int(11),
    tipo varchar(12),
    antigo varchar(100),
    atual varchar(100),
    data_atualizar TIMESTAMP
) ; 

CREATE TABLE ean(  
    id_ean int(11) NOT NULL primary key AUTO_INCREMENT,
    ean varchar(100) unique,
    data_atualizar TIMESTAMP
) ; 

CREATE TABLE usuario(  
    id_usuario int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120),
    login varchar(80) unique,
    senha varchar(80),
    id_nivel int(11),
    ativo int(1),
    data_atualizar TIMESTAMP
); 

CREATE TABLE nivel(  
    id_nivel int(11) NOT NULL primary key AUTO_INCREMENT,
    nome varchar(120) unique,
    vendedor varchar(1),
    estoquista varchar(1),
    gerente varchar(1),
    administrador varchar(1)
    data_atualizar TIMESTAMP
);










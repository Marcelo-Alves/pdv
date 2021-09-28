<?php
include_once 'mysql.php';
class busca  {   
    public static function Retorno($campo,$tabela) {
        try {
            $sql= "SELECT $campo FROM $tabela;";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    
    public static function buscaTudo($campo,$tabela) {
        try {
            $sql= "SELECT $campo FROM $tabela;";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    public static function buscaWhere($campo,$tabela,$where) {
        try {
            $sql= "SELECT $campo FROM $tabela where 1=1 ;";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    
}
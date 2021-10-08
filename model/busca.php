<?php
include_once 'mysql.php';
class busca  {   
    public static function Retorno($campo,$tabela,$ordem =null) {
        try {
            $sql= "SELECT $campo FROM $tabela $ordem ;";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    
    public static function buscaTudo($campo,$tabela,$ordem =null) {
        try {
            $sql= "SELECT $campo FROM $tabela $ordem ;";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    public static function buscaWhere($campo,$tabela,$where,$ordem =null) {
        try {
            $sql= "SELECT $campo FROM $tabela WHERE 1=1 $where $ordem;";
			//echo $sql;
			$rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    
}
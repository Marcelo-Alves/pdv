<?php
include_once 'mysql.php';
class alterar  {   

    public static function alterarBanco($campos,$tabela,$where) {
        try {
            $sql= "UPDATE $tabela SET $campos WHERE $where;";			
			//echo $sql;
			
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }       
    }
    
}
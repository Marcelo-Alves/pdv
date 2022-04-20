<?php
include_once 'mysql.php';
class alterar  {   

    public static function alterarBanco($campos,$tabela,$where) {
        try {
            $sql= "UPDATE $tabela SET $campos WHERE $where;";			
			
			
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();

            //echo  " Erro sql ". $sql;
            
        } catch (Exception $ex) {
            echo $ex->getMessage() . " Erro sql ". $sql;
        }       
    }
    
}
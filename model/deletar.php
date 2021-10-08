<?php
include_once 'mysql.php';
class deletar  {   

    public static function deletarBanco($tabela,$where) {
        try {
            $sql= "delete from $tabela WHERE $where;";			
			echo $sql;
			
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }       
    }
    
}
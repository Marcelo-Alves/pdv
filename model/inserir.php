<?php
include_once 'mysql.php';
class inserir  {   
    
    public static function inserirBanco($campos,$tabela) {
        try {            
            $sql= "INSERT INTO $tabela values ($campos);";
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }        
    }
    
}
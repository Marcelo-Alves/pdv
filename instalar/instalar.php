<?php
include_once 'mysql.php';
try{
   
    $sql = file_get_contents("../sql/sql.sql");
    $rs = mysql::conexao()->prepare($sql);  
    $rs->execute();
}
catch(Exception $erro){
    echo "Erro ao " . $erro->getMessage() ."<br>" . $sql;
}
?>
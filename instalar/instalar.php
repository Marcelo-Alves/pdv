<?php
include_once '../model/mysql.php';
try{
    $sql = // Carrega o arquivo .SQL
    $file = file_get_contents("bdVirgem.sql");
    $rs = mysql::conexao()->prepare($sql);  
    $rs->execute();
}
catch(Exception $erro){
    echo "Erro ao " . $erro->getMessage();
}
?>
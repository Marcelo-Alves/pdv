<?php
include_once '../model/mysql.php';
try{
    $rs = mysql::conexao()->prepare($sql);  
    $rs->execute();
}
catch(Exception $erro){
    echo "Erro ao " . $erro->getMessage();
}
?>
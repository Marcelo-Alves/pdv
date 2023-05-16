<?php
include_once '../conf/definicao.php';
include_once '../model/mysql.php';
try{
    $sql = file_get_contents("../sql/sql.sql");
    $rs = mysql::conexao()->prepare($sql);  
    $rs->execute();
    echo "<br> <br> <br> <h1>Executou com sucesso !</h1>";
}
catch(Exception $erro){
    echo "Erro ao " . $erro->getMessage() ."<br>" . $sql;
}
?>
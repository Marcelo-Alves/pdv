<?php
class mysql {
    public static function conexao(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=pdv', "root", "indios");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (Exception $e) {
          print "Ocorreu um erro ao tentar executar esta ação,
          foi gerado um LOG do mesmo, tente novamente mais tarde.";
      }
    }
}

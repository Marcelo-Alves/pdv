<?php

include_once './model/busca.php';

class fetch{

    public static function lista(){

        foreach ($_POST as $campo => $chave){
            echo $campo . ' '. $chave.'<br>';
          }

        $tabela = $_POST['tabela'];
        $item = $_POST['item'];

        $retorno = busca::buscaWhere('*',$tabela,);
        //                buscaTudo('*',$tabela," order by id_categoria");
        return $retorno;
   }

}
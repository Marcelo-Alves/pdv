<?php

include_once './model/busca.php';

class fetch{

    public static function lista(){
        $tabela  = $_POST['tabela'];
        $like = " and nome like '%" .$_POST['like']."%' ";

        $retorno = busca::buscaWhere('id_cliente,nome,email,cpf',$tabela,$like);

        echo json_encode($retorno);
   }

}
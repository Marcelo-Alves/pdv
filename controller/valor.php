<?php

    include_once './model/busca.php';
    include_once './model/inserir.php';
    include_once './model/alterar.php';

    class valor{
        public static function lista(){
            $produto = busca::buscaTudo('*','produto',"order by id_categoria");
            return $produto;
        }
    }
?>
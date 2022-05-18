<?php

    include_once './model/busca.php';
    include_once './model/inserir.php';
    include_once './model/alterar.php';

    class valor{
        public static function lista(){
            $produto = busca::buscaWhere('*',
            'pdv.produto p inner join pdv.valor_venda v on p.id_produto=v.id_produto',
            ' and valor_atual=1',"order by id_categoria");
            return $produto;
        }
 
        public static function buscavalor(){
            $produto = busca::buscaWhere('*',
            'pdv.produto p inner join pdv.valor_venda v on p.id_produto=v.id_produto',
            ' and valor_atual=1',"order by id_categoria");

            if(count($produto) > 0){
                echo json_encode($produto);
            }
            else{
                echo json_encode(array(0 => array("erro"=>"vazio")));
            } 
        }
    }

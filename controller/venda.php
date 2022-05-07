<?php
/* Informa o nível dos erros que serão exibidos * /
error_reporting(E_ALL); 
/* Habilita a exibição de erros * /
ini_set("display_errors", 1); */


include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class venda{
	


    public static function fetchproduto(){
		$nome = $_POST['nome'];
		$where = ($nome == ""?"":" and p.nome like '%".$nome."%'");
		$produtos = busca::buscaWhere('p.id_produto,p.nome','produto p',$where,"");

		if(count($produtos) > 0){
			echo json_encode($produtos);
		}
		else{
			echo json_encode(array(0 => array("erro"=>"vazio")));
		} 
    }
	
	
}

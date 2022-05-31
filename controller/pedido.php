<?php

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class pedido{

    public static function busca($pedido){

        $campo ="v.venda as venda,v.id_venda,p.nome as produto,v.quantidade,v.valor_venda as unitario,f.nome as funcionario,v.quantidade * v.valor_venda as valor";
        $tabela ="pedido_venda v inner join produto p on v.id_produto=p.id_produto inner join 
        funcionario f on v.id_funcionario=f.id_funcionario ";
		$where = " and v.venda =".$pedido;
        $ordem ="order by v.id_venda";

		$vendas = busca::buscaWhere($campo,$tabela,$where,$ordem);

		echo json_encode($vendas);
    }
	
	
	 public static function buscapedido($pedido){

        $campo ="v.venda as venda,v.id_venda,p.nome as produto,v.quantidade,v.valor_venda as unitario,f.nome as funcionario,v.quantidade * v.valor_venda as valor";
        $tabela ="pedido_venda v inner join produto p on v.id_produto=p.id_produto inner join 
        funcionario f on v.id_funcionario=f.id_funcionario ";
		$where = " and v.venda =".$pedido;
        $ordem ="order by v.id_venda";

		$vendas = busca::buscaWhere($campo,$tabela,$where,$ordem);

		return $vendas;
    }
	

    public static function inserir(){

		$campos_inserir = array(
			'venda'        	  => $_POST['id_venda'],
            'id_funcionario'  => $_POST['id_funcionario'],
            'valor_venda'     => $_POST['valor_venda'],
            'id_cliente'      => $_POST['id_cliente'],
            'quantidade'      => $_POST['qtde'],
			'id_produto'      => $_POST['id_produto'],
			'data_venda'      => date('Y-m-d H:i:s')
		);
		
		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);

		$tabela = 'pedido_venda';
		$campo = 'quantidade';
		$where = 'venda ='.$_POST['id_venda'].' and  id_funcionario  ='. $_POST['id_funcionario'].'
				 and id_produto ='. $_POST['id_produto'];

		$quantidade = busca::buscaWhere($campo,$tabela, ' and '.$where);

		if(isset($quantidade[0]->quantidade)){
			$campos = 'quantidade='.($_POST['qtde'] + $quantidade[0]->quantidade);
			alterar::alterarBanco($campos,$tabela,$where);
		}
		else{
			inserir::inserirBanco($tabela,$model_campos,$model_valores) ;
		}

        pedido::busca($_POST['id_venda']);
	
	}	
	
	public static function alteraprodutopedido(){
		$tabela = 'pedido_venda';
		$campos = 'quantidade='.($_POST['qtde']);
		$where = 'id_venda ='.$_POST['id_venda'];
		
		alterar::alterarBanco($campos,$tabela,$where);
		
		pedido::busca($_POST['venda']);
		
	}
	
	

	public static function limparpedido(){
		$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
		$u = explode('/',$url);
		$id = $u[3];

		$tabela = 'pedido_venda';
		$where = 'venda ='.$id;

		deletar::deletarBanco($tabela,$where);

		header("Location: /pedido");
		die();


	}
	
}

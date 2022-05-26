<?php

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class pedido{

    public static function busca($pedido){
		//$pedido = $_POST['pedido'];
        $campo ="p.nome as produto,v.quantidade,v.valor_venda as unitario,f.nome as funcionario,v.quantidade * v.valor_venda as valor";
        $tabela ="pedido_venda v inner join produto p on v.id_produto=p.id_produto inner join 
        funcionario f on v.id_funcionario=f.id_funcionario ";
		$where = " and v.venda =".$pedido;
        $ordem ="order by v.id_venda";

		$vendas = busca::buscaWhere($campo,$tabela,$where,$ordem);

		echo json_encode($vendas);
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
		
		inserir::inserirBanco('pedido_venda',$model_campos,$model_valores) ;

        pedido::busca($_POST['id_venda']);
	
	}	
	
}

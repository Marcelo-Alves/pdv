<?php
/*include_once '../model/busca.php';
include_once '../model/inserir.php';*/

//$metodo = $_GET['action'];

class produto{
	public static function lista(){
		
			echo "Lista";
		/* $produto = buscaTudo('*','produto');
		 return $produto;*/
	}
	
	public static function inserir(){
		$campos_inserir = array(
			'nome'         	  => $_POST['nome'],
			'validade'        => $_POST['validade'],
			'validade_dias'   => $_POST['validade_dias'],
			'data_criar'      => date('Y-m-d H:i:s')
		);
		
		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		inserir::inserirBanco('produto',$model_campos,$model_valores) ;
		/*
		echo "insert into produto (".$model_campos .")  values (" . $model_valores . ")";
		/ * /echo "<pre>";
		print_r($campos_inserir);
		print_r($lista_campos);
		echo "</pre>";
		 $produto = buscaTudo('*','produto');
		 return $produto;*/
	}
}
if(method_exists(produto::class,$_POST['METODO'])){
	produto::$_POST['METODO']();
}
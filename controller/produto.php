<?php
include_once './model/busca.php';
include_once './model/inserir.php';

$acao = $_GET['acao'];

class produto{
	public static function lista(){
		 $produto = busca::buscaTudo('*','produto');
		 return $produto;
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
		
		$ins = inserir::inserirBanco('produto',$model_campos,$model_valores) ;
		//echo "iNSERIR";
		
		header("Location: /produto");
		die();
	}
}

if($acao != null){
	produto::$acao();	
}
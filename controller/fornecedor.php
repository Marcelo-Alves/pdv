<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class fornecedor{
	public static function lista(){
		 $fornecedor = busca::buscaTudo('*','fornecedor');
		 //print_r($fornecedor);
		 return $fornecedor;
	}
	
	public static function inserir(){
		$campos_inserir = array(
			'nome'         	=> strtoupper($_POST['nome']),
			'cnpj'			=> $_POST['cnpj'],
			'data_criar'    => date('Y-m-d H:i:s')
		);
		
		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		inserir::inserirBanco('fornecedor',$model_campos,$model_valores) ;
		
		header("Location: /fornecedor");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_fornecedor = ".$id;			
		$fornecedor = busca::buscaWhere("*","fornecedor",$where);		
		return $fornecedor ;
		
	}
	
	public static function alterar(){
		$campos_alterar =
			'nome="'       		.strtoupper($_POST['nome']).'" ,'.
			'cnpj="'      		. $_POST['cnpj'].'" ,'.
			'data_atualizar="'	. date('Y-m-d H:i:s').'"';
			
		$where ='id_fornecedor="'.$_POST['id_fornecedor'].'"';
		alterar::alterarBanco($campos_alterar,"fornecedor",$where);
		header("Location: /fornecedor");
		die();
	}
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];

		$where ='id_fornecedor="'.$id.'"';
		deletar::deletarBanco("fornecedor",$where);
		header("Location: /fornecedor");
		die();
	}
}

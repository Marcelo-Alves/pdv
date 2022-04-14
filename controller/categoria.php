<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class categoria{
	public static function lista(){
		 $categoria = busca::buscaTudo('*','categoria');
		 return $categoria;
	}
	
	public static function inserir(){
		$campos_inserir = array(
			'nome'         	  => strtoupper($_POST['nome']),
			'ativo'        => $_POST['ativo'],
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
		
		inserir::inserirBanco('categoria',$model_campos,$model_valores) ;
		
		header("Location: /categoria");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_categoria = ".$id;			
		$categoria = busca::buscaWhere("*","categoria",$where);		
		return $categoria ;	
	}
	
	public static function alterar(){
		$campos_alterar =
			'nome="'       		.strtoupper($_POST['nome']).'" ,'.
			'ativo="'      		. $_POST['ativo'].'" ,'.
			'data_atualizar="'	. date('Y-m-d H:i:s').'"';
			
		$where ='id_categoria="'.$_POST['id_categoria'].'"';
		alterar::alterarBanco($campos_alterar,"categoria",$where);
		header("Location: /categoria");
		die();
	}
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];

		$where ='id_categoria="'.$id.'"';
		deletar::deletarBanco("categoria",$where);
		header("Location: /categoria");
		die();
	}
}

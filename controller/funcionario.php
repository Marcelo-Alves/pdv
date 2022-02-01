<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class Funcionario{
	public static function lista(){
		 $funcionario = busca::buscaTudo('*','funcionario');
		 return $funcionario;
	}
	
	public static function inserir(){
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		/*
		$campos_inserir = array(
			'nome'            => strtoupper($_POST['nome']),
			'caixa' 	      => isset($_POST['caixa'])      ? '1' : '0' ,
			'venda' 	      => isset($_POST['venda'])      ? '1' : '0' ,
			'estoque'         => isset($_POST['estoque'])    ? '1' : '0' ,
			'produto'         => isset($_POST['produto'])    ? '1' : '0' ,
			'usuario'         => isset($_POST['usuario'])    ? '1' : '0' ,
			'fornecedor'      => isset($_POST['fornecedor']) ? '1' : '0' ,
			'empresa'         => isset($_POST['empresa'])    ? '1' : '0' ,
			'sangria'         => isset($_POST['sangria'])    ? '1' : '0' ,
			'relatorio'       => isset($_POST['relatorio'])    ? '1' : '0' ,
			'desconto'        => isset($_POST['desconto'])    ? '1' : '0' ,
			'valor_desconto'  => str_replace( ",", ".",$_POST['valor_desconto']),
			'excluir_item'    => isset($_POST['excluir_item'])    ? '1' : '0' ,
			'data_criar'      => date('Y-m-d H:i:s'),
			'data_atualizar'  => date('Y-m-d H:i:s')
		);

		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		inserir::inserirBanco('nivel',$model_campos,$model_valores) ;
		
		header("Location: /funcionario");
		die();*/
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_nivel = ".$id;			
		$categoria = busca::buscaWhere("*","nivel",$where);		
		return $categoria ;	
	}
	
	public static function alterar(){
		$campos_alterar ='nome="' . strtoupper($_POST['nome']).'" ,'.
		'caixa  	      ="' . (isset($_POST['caixa'])? 1 : 0).'" ,'.
		'venda  	      ="' . (isset($_POST['venda'])? 1 : 0).'" ,'.		
		'estoque          ="' . (isset($_POST['estoque'])? 1 : 0).'" ,'.
		'produto          ="' . (isset($_POST['produto'])? 1 : 0) .'" ,'.
		'usuario          ="' . (isset($_POST['usuario'])? 1 : 0).'" ,'.
		'fornecedor       ="' . (isset($_POST['fornecedor']) ? 1 : 0) .'" ,'.
		'empresa          ="' . (isset($_POST['empresa']) ? 1 : 0) .'" ,'.
		'sangria          ="' . (isset($_POST['sangria']) ? 1 : 0) .'" ,'.
		'relatorio        ="' . (isset($_POST['relatorio']) ? 1 : 0) .'" ,'.
		'desconto         ="' . (isset($_POST['desconto'])    ? '1' : '0') .'" ,'.
		'valor_desconto   ="' . str_replace( ",", ".",$_POST['valor_desconto']) .'" ,'.
		'excluir_item     ="' . (isset($_POST['excluir_item']) ? 1 : 0) .'" ,'.
		'data_criar       ="' . date('Y-m-d H:i:s').'" ,'.
		'data_atualizar   ="'. date('Y-m-d H:i:s').'" ';			
		$where ='id_nivel ="'.$_POST['id_nivel'].'"';
		alterar::alterarBanco($campos_alterar,"nivel",$where);
		header("Location: /nivel");
		die();
	}
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];

		$where ='id_nivel="'.$id.'"';
		deletar::deletarBanco("nivel",$where);
		header("Location: /nivel");
		die();
	}
}

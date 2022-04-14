<?php
/* Informa o nível dos erros que serão exibidos * /
error_reporting(E_ALL); 
/* Habilita a exibição de erros * /
ini_set("display_errors", 1); */


include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class ean{
	public static function lista(){
		 $produto = busca::buscaTudo('*','ean as e inner join produto as p on e.id_produto=p.id_produto','order by id_categoria');
		 return $produto;
	}

	public static function buscaean(){
        $url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[2];
		
		$ean = busca::buscaWhere('p.nome,p.id_produto,e.id_ean,e.ean','ean as e right join produto as p on e.id_produto=p.id_produto','and p.id_produto ='.$id);
		//print_r($ean);
		
		return $ean; //*/
   	}

	public static function inserir(){
		$campos_inserir = array(
			'ean'         	  => $_POST['ean'],
			'id_produto'      => $_POST['id_produto'],
			'data_atualizar'  => date('Y-m-d H:i:s')
		);
		echo "<pre>";
		print_r ($campos_inserir);
		echo "</pre>";
		
		if(count(busca::buscaWhere('*','ean','and ean ="'.$campos_inserir['ean'].'" and id_produto='.$campos_inserir['id_produto'])) > 0){

			header("Location: /validar/".$campos_inserir['id_produto']);
			die();
		}

		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		inserir::inserirBanco('ean',$model_campos,$model_valores) ;
		echo "iNSERIR";
		header("Location: /ean/".$campos_inserir['id_produto']);
		die();
	}
	
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
        $id_produto =$u[3];
		$id = $u[4];		
		$where="id_ean = ".$id;			
		deletar::deletarBanco('ean',$where) ;	
		header("Location: /ean/".$id_produto);
		die();
	}
	
	
}

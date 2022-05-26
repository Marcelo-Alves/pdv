<?php

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class Funcionario{
	public static function lista(){
		 $funcionario = busca::buscaTudo('f.id_funcionario,f.nome,f.cpf,f.email,n.nome as nivel','funcionario f inner join nivel n on f.id_nivel=n.id_nivel');
		 return $funcionario;
	}
	
	public static function inserir(){

		$campos_inserir = array(
			'nome'            => strtoupper($_POST['nome']),
			'telefone' 	      => $_POST['telefone'],
			'email' 	      => $_POST['email'],	
			'cpf' 	          => $_POST['cpf'],	
			'matricula' 	  => $_POST['matricula'],	
			'usuario' 	      => $_POST['usuario'],	
			'senha' 	      => $_POST['senha'],	
			'id_nivel' 	      => $_POST['id_nivel'],	
			'ativo' 	      => isset($_POST['ativo'])? '1' : '0' ,
			'trocasenha' 	  => isset($_POST['trocasenha'])? '1' : '0' ,
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
		
		inserir::inserirBanco('funcionario',$model_campos,$model_valores) ;
		
		header("Location: /funcionario");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_funcionario = ".$id;			
		$categoria = busca::buscaWhere("*","funcionario",$where);	
		
		return $categoria ;	
	}
	
	public static function alterar(){

		$campos_alterar = 'nome ="'. strtoupper($_POST['nome']) .'",
			telefone       ="'. $_POST['telefone'].'",
			email 	       ="'. $_POST['email'].'",
			cpf 	       ="'. $_POST['cpf'].'",
			matricula      ="'. $_POST['matricula'].'",
			usuario        ="'. $_POST['usuario'].'",
			id_nivel       ="'. $_POST['id_nivel'].'",
			ativo 	       ="'.( isset($_POST['ativo']) ? '1' : '0') .'",
			trocasenha 	   ="'.( isset($_POST['trocasenha']) ? '1' : '0') .'",
			data_criar     ="'. date('Y-m-d H:i:s').'",
			data_atualizar ="'. date('Y-m-d H:i:s') .'"';
			$campos_alterar . ($_POST['senha']='')  ? ',senha="'. $_POST['senha'].'",':'';

			//echo $campos_alterar;

		$where ='id_funcionario ="'.$_POST['id_funcionario'].'"';
		alterar::alterarBanco($campos_alterar,"funcionario",$where);
		header("Location: /funcionario");
		die();
	}
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];

		$where ='id_funcionario="'.$id.'"';
		deletar::deletarBanco("funcionario",$where);
		header("Location: /funcionario");
		die();
	}
}

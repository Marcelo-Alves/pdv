<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class Cliente{
	public static function lista(){
		 $funcionario = busca::buscaTudo('*','cliente');
		 return $funcionario;
	}
	
	public static function inserir(){
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		//*/
		$campos_inserir = array(
			'nome'            => strtoupper($_POST['nome']),
			'telefone' 	      => $_POST['telefone'],
			'email' 	      => $_POST['email'],	
			'cpf' 	          => $_POST['cpf'],	
			'cep' 	          => $_POST['cep'],	
			'bairro' 	      => $_POST['bairro'],	
			'rua' 	          => $_POST['rua'],	
			'numero' 	      => $_POST['numero'],	
			'cidade' 	      => $_POST['cidade'],	
			'UF' 	          => $_POST['estado'],		
			'limite' 	      => $_POST['limite'],	
			'ativo' 	      => isset($_POST['ativo'])? '1' : '0' ,
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
		
		inserir::inserirBanco('cliente',$model_campos,$model_valores) ;
		
		header("Location: /cliente");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_cliente = ".$id;			
		$categoria = busca::buscaWhere("*","cliente",$where);		
		return $categoria ;	
	}
	
	public static function alterar(){
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/


		$campos_alterar = 'nome ="'. strtoupper($_POST['nome']).'",'.
				'telefone 	    ="'. $_POST['telefone'].'",'.
				'email  	    ="'. $_POST['email'].'",'.
				'cpf 	        ="'. $_POST['cpf'].'",'.	
				'cep   	        ="'. $_POST['cep'].'",'.	
				'bairro 	    ="'. $_POST['bairro'].'",'.	
				'rua 	        ="'. $_POST['rua'].'",'. 
				'numero 	    ="'. $_POST['numero'].'",'.	
				'cidade 	    ="'. $_POST['cidade'].'",'.	
				'UF 	        ="'. $_POST['estado'].'",'.		
				'limite 	    ="'. $_POST['limite'].'",'.	
				'ativo 	        ="'. (isset($_POST['ativo'])? '1' : '0').'",'.
				'data_atualizar ="'. date('Y-m-d H:i:s').'"';
		
		

		$where = 'id_cliente="'. $_POST['id_cliente'].'"';
		alterar::alterarBanco($campos_alterar,"cliente",$where);
		header("Location: /cliente");
		die();
	}
	public static function deletar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];

		$where ='id_cliente="'.$id.'"';
		deletar::deletarBanco("cliente",$where);
		header("Location: /cliente");
		die();
	}
}

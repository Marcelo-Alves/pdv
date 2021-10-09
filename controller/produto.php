<?php
/* Informa o nível dos erros que serão exibidos * /
error_reporting(E_ALL); 
/* Habilita a exibição de erros * /
ini_set("display_errors", 1); */


include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';

class produto{
	public static function lista(){

		 $produto = busca::buscaTudo('*','produto',"order by id_categoria");
		 return $produto;
	}

	public static function categoria(){
		$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
		$u = explode('/',$url);
		$id = $u[3];
		$produto = busca::buscaWhere('*','produto',"and id_categoria = $id","") ;
		return $produto;
	}

	public static function buscacategorias(){
		$produto = busca::buscaWhere('id_categoria,nome','categoria','and ativo = 1');
		return $produto;
   	}

	public static function buscafetch(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$nome = $u[3];		
		$where=" and nome like '%".$nome."%'";			
		$listas = busca::buscaWhere("*","produto",$where);		
		/*
		print_r($listas);
		/*/
		
		echo '<table class="table table-striped table-hover">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">id</th>';
		echo '<th scope="col">Nome</th>';
		echo '<th scope="col">Validade</th>';
		echo '<th scope="col">Validade Dias</th>';
		echo '<th scope="col">Código Produto</th>';
		echo '<th scope="col">Editar</th>';
		echo '<th scope="col">Deletar</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($listas as $lista):

			echo '<td scope="row">'.$lista->id_produto .'</th>';
			echo '<td scope="row">'.$lista->nome .'</td>';
			echo '<td scope="row">'.($lista->validade==0?"Não":"Dias").'</td>';
			echo '<td scope="row">'.$lista->validade_dias.'</td>';
			echo '<td scope="row">';
			echo '<a href="./ean/.$lista->id_produto ">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/ean.png" width="45px" > ';
			echo '</a>';
			echo '</td>';
			echo '<td scope="row">';
			echo '<a href="./produto/editar/<?php echo $lista->id_produto ;?>">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/editar.png" width="30px" > ';
			echo '</a>';
			echo '</td>';
			echo '<td scope="row">';
			echo '<a href="./produto/deletar/<?php echo $lista->id_produto ;?>">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/lixeira.png" width="30px" > '; 
			echo '</a>';
			echo '</td>';
			echo '</tbody>';
		endforeach;
		echo '</table>'; 
				
	}







	public static function inserir(){
		$campos_inserir = array(
			'nome'         	  => $_POST['nome'],
			'validade'        => $_POST['validade'],
			'id_categoria'    => $_POST['id_categoria'],
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
		//echo "iNSERIR";
		
		header("Location: /produto");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_produto = ".$id;			
		$produto = busca::buscaWhere("*","produto",$where);		
		return $produto ;	
	}
	
	public static function alterar(){
		$campos_alterar =
			'nome="'          .$_POST['nome'].'" ,'.
			'validade="'      . $_POST['validade'].'" ,'.
			'validade_dias="' . $_POST['validade_dias'].'" ,'.
			'id_categoria="'  .$_POST['id_categoria'].'",'.
			'data_atualizar="'. date('Y-m-d H:i:s').'"';
			
		$where ='id_produto="'.$_POST['id_produto'].'"';
		alterar::alterarBanco($campos_alterar,"produto",$where);
		header("Location: /produto");
		die();
	}
}

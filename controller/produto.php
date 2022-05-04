<?php

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

	public static function categorias(){
		$id_categoria = $_POST['categoria'];
		$where = ($id_categoria == ""?"":" and id_categoria = $id_categoria");		
		$categoria = busca::buscaWhere('p.id_produto,p.nome','produto p',$where,"") ;
		
		if(count($categoria) > 0){
			echo json_encode($categoria);
		}
		else{
			echo json_encode(array(0 => array("erro"=>"vazio")));
		}
	}
	
	public static function buscaproduto(){
		$nome = $_POST['nome'];
		$where = ($nome == ""?"":" and p.nome like '%".$nome."%'");
		$produtos = busca::buscaWhere('p.id_produto,p.nome','produto p',$where,"");

		if(count($produtos) > 0){
			echo json_encode($produtos);
		}
		else{
			echo json_encode(array(0 => array("erro"=>"vazio")));
		} 
    }

	public static function Buscafornecedor(){
		$id_fornecedor = $_POST['fornecedor'];
		$where = ($id_fornecedor == ""?"":" and id_fornecedor = $id_fornecedor");		
		$fornecedor = busca::buscaWhere('p.id_produto,p.nome','produto p',$where) ;
		
		if(count($fornecedor) > 0){
			echo json_encode($fornecedor);
		}
		else{
			echo json_encode(array(0 => array("erro"=>"vazio")));
		}
	}




	public static function buscacategorias(){
		$produto = busca::buscaWhere('id_categoria,nome','categoria','and ativo = 1');
		return $produto;
   	}	
	
	
	
	public static function buscafornecedores(){
		$produto = busca::buscaWhere('id_fornecedor,nome','fornecedor','');
		
		return $produto;
   	}
	
	public static function buscafetch(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$nome = $u[3];		
		$where=" and nome like '%".$nome."%'";			
		$listas = busca::buscaWhere("*","produto",$where);		
		
		if(count($listas) == 0){
			echo '<table class="table table-striped table-hover">';
			echo '<tr>';
			echo '<th scope="col" style="font-size: 30px;text-align:center;vertical-align:middle">';
			echo 'Não existe dados com o produto digitado';
			echo '</th>';
			echo '</tr>';
			echo '</table>';
			return;

		}
		
		echo '<table class="table table-striped table-hover">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col">id</th>';
		echo '<th scope="col">Nome</th>';
		echo '<th scope="col">Código Produto</th>';
		echo '<th scope="col">Editar</th>';
		echo '<th scope="col">Deletar</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($listas as $lista){

			echo '<td scope="row">'.$lista->id_produto .'</th>';
			echo '<td scope="row">'.$lista->nome .'</td>';
			echo '<td scope="row">';
			echo '<a href="./ean/'.$lista->id_produto .'">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/ean.png" width="45px" > ';
			echo '</a>';
			echo '</td>';
			echo '<td scope="row">';
			echo '<a href="./produto/editar/'. $lista->id_produto .'">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/editar.png" width="30px" > ';
			echo '</a>';
			echo '</td>';
			echo '<td scope="row">';
			echo '<a href="./produto/deletar/'.$lista->id_produto .'">';
			echo '<img src="http://'. $_SERVER['HTTP_HOST'].'/biblioteca/img/lixeira.png" width="30px" > '; 
			echo '</a>';
			echo '</td>';
			echo '</tbody>';
		}
		echo '</table>'; 
				
	}

	public static function inserir(){
		$campos_inserir = array(			
			'id_fornecedor'  => "'".$_POST['id_fornecedor']."'",
			'id_categoria'   => "'".$_POST['categoria']."'",
			'nome'         	 => "'". strtoupper($_POST['nome'])."'",
			'data_criar'     => "'". date('Y-m-d H:i:s')."'",
			'data_atualizar' => "'". date('Y-m-d H:i:s')."'",
		);
		
		/*echo "<pre>";
		print_r($campos_inserir);
		echo "</pre>";*/
		
		
		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "" . $nome . ",";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		
		inserir::inserirBanco('produto',$model_campos,$model_valores) ;
		
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
			'nome="'          .strtoupper($_POST['nome']).'" ,'.
			'validade="'      . $_POST['validade'].'" ,'.
			'validade_dias="' . $_POST['validade_dias'].'" ,'.
			'id_categoria="'  .$_POST['id_categoria'].'",'.
			'id_fornecedor="'  .$_POST['id_fornecedor'].'",'.
			'data_atualizar="'. date('Y-m-d H:i:s').'"';
			
		$where ='id_produto="'.$_POST['id_produto'].'"';
		alterar::alterarBanco($campos_alterar,"produto",$where);
		header("Location: /produto");
		die();
	}
}
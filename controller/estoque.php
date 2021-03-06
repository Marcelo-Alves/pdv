<?php
/* Informa o nível dos erros que serão exibidos * /
error_reporting(E_ALL); 
/* Habilita a exibição de erros * /
ini_set("display_errors", 1); */


include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';

class estoque{
	public static function lista(){
		 $produto = busca::buscaTudo('e.id_estoque as id_estoque,p.nome as produto,p.id_produto,e.quantidade as quantidade ,
		 e.lote as lote ,c.nome as categoria',
		 'estoque e inner join produto p on e.id_produto = p.id_produto
		 inner JOIN categoria c on p.id_categoria = c.id_categoria ',
		 "ORDER BY p.id_produto");
		 return $produto;
	}

	public static function categoria(){
		$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
		$u = explode('/',$url);
		$id = $u[3];
		$produto = busca::buscaWhere
		('p.nome as produto,p.id_produto,SUM( e.quantidade) as quantidade ,
		e.lote as lote ,DATE_FORMAT(e.validade,"%d/%m/%Y") as validade,c.nome as categoria',
		'estoque e inner join produto p on e.id_produto = p.id_produto
		inner JOIN categoria c on p.id_categoria = c.id_categoria  ',
		 "and p.id_categoria = $id",
		 "GROUP by p.nome, p.id_produto,e.lote,c.nome,DATE_FORMAT(e.validade,'%d/%m/%Y') order by p.nome");
		/*
		('f.nome as fornecedor,c.nome as categoria,p.*','pdv.produto as p inner join pdv.fornecedor as f  
		on p.id_fornecedor = f.id_fornecedor 
		inner join pdv.categoria as c on p.id_categoria = c.id_categoria',"and p.id_categoria = $id","") ;*/
		return $produto;
	}
	
	public static function fornecedor(){
		$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
		$u = explode('/',$url);
		$id = $u[3];
		$produto = busca::buscaWhere('*','produto',"and id_fornecedor = $id","") ;
		//print_r($produto);
		return $produto;
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
		$where=" and p.nome like '%".$nome."%' ORDER BY p.nome";			
		$listas = busca::buscaWhere('e.id_estoque as id_estoque,p.nome as produto,p.id_produto,e.quantidade as quantidade ,
		e.lote as lote ,c.nome as categoria',
		'estoque e inner join produto p on e.id_produto = p.id_produto
		inner JOIN categoria c on p.id_categoria = c.id_categoria ',$where);		
		
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
		echo '<th scope="col">Categória</th>';
		echo '<th scope="col">Lote</th>';
		echo '<th scope="col">Quantidade</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($listas as $lista):
			echo '<td scope="row">'.$lista->id_estoque .'</th>';
			echo '<td scope="row">'.$lista->produto .'</td>';
			echo '<td scope="row">'.$lista->categoria.'</td>';
			echo '<td scope="row">'.$lista->lote.'</td>';			
			echo '<td scope="row">'.$lista->quantidade.'</td>';
			echo '</td>';
		endforeach;
		echo '</tbody>';
		echo '</table>'; 
				
	}

	public static function inserir(){
		$data = date_create($_POST['validade']);
		
		$campos_inserir = array(
			'id_produto'   => $_POST['id_produto'],
			'id_estoque'   => $_POST['id_estoque'],
			'quantidade'   => $_POST['quantidade'],
			'validade'     => date_format($data, 'Y-m-d H:i:s'),
			'lote'         => $_POST['lote'],
			'data_atualizar'  => date('Y-m-d H:i:s')
		);
		$where=" and id_estoque = " .$_POST['id_estoque'] ." and lote = " .$_POST['lote'] ;			
		$listas = busca::buscaWhere("*","visao_estoque",$where);	

		//print_r($campos_inserir);
		$model_campos="";
		$model_valores="";
		
		foreach($campos_inserir as $campos => $nome){
			$model_campos = $model_campos . $campos . ",";
			$model_valores  = $model_valores . "'" . $nome . "',";
		}
		
		$model_campos = substr($model_campos,0,-1);
		$model_valores  = substr($model_valores,0,-1);
		
		inserir::inserirBanco('estoque',$model_campos,$model_valores) ;

		$where=" and id_produto = ".$_POST['id_produto'];			
		$produto = busca::buscaWhere("*","visao_estoque",$where);	
		
		header("Location: /estoque");
		die();
	}
	
	public static function editar(){
		$url = $_SERVER['REQUEST_URI'];
		$u = explode('/',$url);
		$id = $u[3];		
		$where=" and id_estoque = ".$id;			
		$produto = busca::buscaWhere("*","visao_estoque",$where);		
		return $produto ;	
	}
	
	public static function alterar(){

		$campos_alterar =
			'quantidade="' . $_POST['quantidade'].'" ,'.
			'lote="' . $_POST['lote'].'" ,'.
			'data_atualizar="' . date('Y-m-d H:i:s').'" ';
			
		$where ='id_estoque="'.$_POST['id_estoque'].'"';
		alterar::alterarBanco($campos_alterar,"estoque",$where);

		header("Location: /estoque");
		die();
	}
}

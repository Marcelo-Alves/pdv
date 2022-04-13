<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';
include_once './model/inserir.php';
include_once './model/alterar.php';
include_once './model/deletar.php';

class Login{
	public static function lista(){
		$usuario =$_POST['usuario'];
		$senha =$_POST['senha'];
		$funcionario = busca::buscaWhere('*','funcionario','and usuario="'.$usuario.'" and senha="'.$senha.'"');
		//$funcionario = busca::buscaTudo('f.id_funcionario,f.nome,f.cpf,f.email,n.nome as nivel','funcionario f inner join nivel n on f.id_nivel=n.id_nivel');
		print_r($funcionario);
		//return $funcionario;
	}
	
}

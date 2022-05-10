<?php 
/* Informa o nível dos erros que serão exibidos */  
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); 
//*/

$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
$u = explode('/',$url);

$classe  = $u[1];
$metodo = (empty($u[2])?"lista":$u[2]);

if(file_exists('./controller/'.$classe.".php") == true)
{
	include_once('./controller/'.$classe.".php") ;
	if(method_exists($classe,$metodo))
	{
		$classe::$metodo();
	}
}

if(file_exists('./view/'.$classe.$metodo.".php") == true)
{
	include_once('./view/'.$classe.$metodo.'.php' );
}
elseif(file_exists('./view/'.$classe.".php") == true)
{	
	include_once('./view/'.$classe.".php" );
}
?>      
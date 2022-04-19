<?php 
/* Informa o nível dos erros que serão exibidos */  
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); 
//*/

$url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
$u = explode('/',$url);
/*
echo "<pre>";
print_r ($u);
echo "</pre>";*/
$classe  = $u[1];
$metodo = (empty($u[2])?"lista":$u[2]);
/*echo "Entrou 1 <br>";
echo $classe.$metodo."<br>";*/

if(file_exists('./controller/'.$classe.".php") == true)
{
	include_once('./controller/'.$classe.".php") ;
	if(method_exists($classe,$metodo))
	{
		$classe::$metodo();
	}
}


/*//*
//echo "Entrou2 <br>";

///*
//var_dump(file_exists('./view/'.$classe.$metodo.".php")); //* /
echo('./view/'.$classe.$metodo.".php"); //* /

echo("<br>"); //* /

echo('./view/'.$classe.".php"); //* */

if(file_exists('./view/'.$classe.$metodo.".php") == true)
{
	//echo "Entrou";
	include_once('./view/'.$classe.$metodo.'.php' );
}
elseif(file_exists('./view/'.$classe.".php") == true)
{	
	include_once('./view/'.$classe.".php" );
}//*/
?>      
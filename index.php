<?php 
    $url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
	$u = explode('/',$url);
	$classe  = $u[1];
	$metodo = (empty($u[2])?"lista":$u[2]);
	
    include_once('./controller/'.$classe.".php" );
	
	if(method_exists($classe,$metodo))
	{
		$classe::$metodo();
	}
	
	if(file_exists('./view/'.$classe.$metodo.".php") == false)
	{
		include_once('./view/'.$classe.'.php' );
	}
	else
	{
		include_once('./view/'.$classe.$metodo.".php" );
	}
	?>      
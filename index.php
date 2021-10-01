<?php 
    $url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']);
	$u = explode('/',$url);
	$classe  = $u[1];
	$metodo = (empty($u[2])?"lista":$u[2]);
	
    include_once('./controller/'.$classe.".php" );   
	$_POST['METODO']=$metodo;
	include_once('./view/'.$classe.$metodo.".php" );
	?>      
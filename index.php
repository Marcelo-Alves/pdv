<?php 
    $url = ($_SERVER['REQUEST_URI']=="/"?"/index":$_SERVER['REQUEST_URI']).".php";
	//echo $url; /*
    include_once('./controller/'.$url);    
    include_once('./view'.$url);
	?>      
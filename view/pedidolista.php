<?php
if(session_start() == false):
	session_start();
endif;

define('titulo', "Tela de Pedido");  


?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Tela de Venda">
	<meta name="author" content="Marcelo Alves">   
	<title><?php echo titulo; ?></title>
    <link href="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/css/bootstrap.css" rel="stylesheet">   
	<link href="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/css/dashboard.css" rel="stylesheet"> 
	<style>
		.col-xs-4 button{font-size: 50px;}
		.col-xs-4{width: 80px; height: 80px;margin: 5px;}
		body{padding-top: 0;}
		.ativo{color:red;}
	</style>
	<script src='<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/js/fetchgenerico.js'></script>
	<script src='<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/js/funcoes.js'></script>   
    <SCript>
		window.setInterval("verificaPedido()",5000);
	</SCript>
  </head>

	<body onload="verificaPedido()">
		<div class="container">
			<div class="row d-flex justify-content-center">
					<p class="text-center display-2"> TELA DE PEDIDO</p>
			</div>
			<div class="row justify-content-md-center">
		<?php  
		for($i=1;$i <= QUANT_PEDIDO;$i++):  ?>
			<div  class="col-xs-4">
				<form action="<?php echo$_SERVER['HTTP_REFERER']?>/venda/" method="POST">
					<input type="hidden" value="<?php echo $i ?>" name="pedido" />

					<button id="<?php echo $i; ?>"><?php echo ($i<10?"0".$i:$i); ?></button>
				</form>
			</div>
		<?php  endfor; ?>
			</div>				
		</div>		
	</body>
</html>
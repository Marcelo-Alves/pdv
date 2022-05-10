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
    <link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/bootstrap.css" rel="stylesheet">   
	<link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/dashboard.css" rel="stylesheet">     
    <style>
		.col-xs-4 button{font-size: 50px;}
		.col-xs-4{width: 80px; height: 80px;}

	</style>
  </head>
	<body>
		<div class="container">
			<div class="row justify-content-md-center">
		<?php  for($i=1;$i<=98;$i++):  ?>
			<div  class="col-xs-4">
				<form action="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/venda/" method="POST">
					<input type="hidden" value="<?php echo $i ?>" name="pedido" />
					<button><?php echo ($i<10?"0".$i:$i)?></button>
				</form>

					
			
			</div>
		<?php  endfor; ?>
			</div>
				<div class="col-3">
					
				</div>
		</div>		
	</body>
</html>
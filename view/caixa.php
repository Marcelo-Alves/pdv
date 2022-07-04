<?php
if(session_start() == false):
	session_start();
endif;


$telas = array('painel','caixa','venda');

$URI = str_replace('/','',$_SERVER['REQUEST_URI']);

if(isset($_SESSION['nome'])):
	if($_SESSION[$URI]!=1):
		for($i=0;$i<=count($telas);$i++):		
			if($_SESSION[$telas[$i]]==1):				
				header("Location: /".$telas[$i]);				
			endif;
		endfor;
	endif;
endif;

define('titulo', "Tela de Caixa");  

$idcaixa = date('ymdHis').rand(100,999);
$idvenda = (isset($_POST['pedido'])?$_POST['pedido']:"01");
include_once('./controller/cliente.php') ;
include_once('./controller/pedido.php') ;
include_once('./controller/funcionario.php') ;
$clientes = cliente::lista();
$funcionarios = funcionario::lista();
$pedidos = pedido::buscapedido($idvenda);
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Tela do Caixa">
	<meta name="author" content="Marcelo Alves">   
	<title><?php echo titulo; ?></title>
    <link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/bootstrap.css" rel="stylesheet">   
	<link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/dashboard.css" rel="stylesheet">     

    <style>
      #pesquisa{border:1px solid #000000;padding:10px;}
	  #itens,#total{border:1px solid #000000;padding:5px;}
	  #vertotal{border:1px solid #000000;padding:5px;}
	  .vertotallabel{padding-bottom:5px;}	  
	  #quant{width: 80px;}
	  #nome_prod{width: 480px;}
	  #principal{border:1px solid #000000;padding:5px;height: 100%;}
	  .aexcluir{font-size: 10px; text-decoration: none;  color: #000000;  margin: 0;   padding: 0;}
	  #valorreal{font-weight: bold;}
	  #qtdetotal{font-weight: bold;}
	  #valortroco{font-weight: bold;}

	</style>
	<script src='<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/js/fetchgenerico.js'></script>
	<script src='<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/js/funcoes.js'></script>

  </head>
	<body  class="pt-0">
		 <div class="container">
				<h1 class="display-2 text-center">CAIXA</h1>
				<div id='principal' class="row">
					
					<div class="row h2">
						VENDA N° <?php echo $idcaixa;?>
						PEDIDO N° <?php echo $idvenda;?>
					</div>
						
					<div class="row" style="margin: 10px;">
						<div class="col-4">
							<div class="row">	
								<input type='hidden' id='idpedido' name='idpedido' value='<?php echo $idvenda;?>'/>
								<form action="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/caixa/" method="POST"  class="row">
									<input type='number' id='pedido' name='pedido' style='width:100px;margin-left:10px;' class="form-control"   placeholder="Pedido" autocomplete="off"/>
									<button type='submit' style="width:70px;margin-left: 10px;">Buscar</button>
								</form>
							</div>
						</div>
						<div class="col-4">
								<select class="form-control" id="id_funcionario" name="id_funcionario" style='width:300px;' >
								<option  value="" disabled selected hidden>Funcionário</option>
									<?php
										foreach($funcionarios as $funcionario):
											$selecionado = ($funcionario->id_funcionario == $_SESSION['id_funcionario'] ? 'selected':'');
											echo "<option value='".$funcionario->id_funcionario."' $selecionado >".$funcionario->nome."</option>";
										endforeach;
									?>
								</select>
						</div>
						<div class="col-4 ">
								
								<select class="form-control" id="id_cliente" name="id_cliente" style='width:300px;' >
								<?php
										foreach($clientes as $cliente):
											$selecionado =($cliente->id_cliente == 0 ? 'selected':'');
											echo "<option value='".$cliente->id_cliente."' $selecionado >".$cliente->nome."</option>";
										endforeach;
									?>
								</select>
						</div>
						
					</div>
					<div class="col-9">
						<div id='pesquisa'>
							<label> Produto </label>
							<input type='text' name='nome_prod' id='nome_prod' onkeypress='autocompletar()' placeholder="Produto ou Ean"/>							
							<input type="hidden" name="id_produto" id="id_produto" >
							<input type="hidden" name="id_venda" id="id_venda" value="<?php echo $idvenda; ?>" >
							<input type="hidden" name="valor_venda" id="valor_venda" >
							<label> Quantidade </label>
							<input type='number' name='quant' id='quant' value="1" />
							<button type="button" onclick="inseririten()"> INCLUIR </button>
						</div>
						<div class="dropdown">
							<span id="popup"></span>
						</div>
						<div id='itens'>
								<table  class="table table-striped table-hover">
									<thead>
										<tr><th  scope="col">Produto</th> 
											<th scope="col"> Quantidade</th>  
											<th scope="col"> Valor Unitário</th>  
											<th scope="col"> Valor</th>  
											<th scope="col"> Vendedor</th>
											<th scope="col"> Excluir</th>
										<tr>
									</thead>
									<tbody id='produto_corpo'>
										<?php 
										$i=0;
										$spvalor=0;
										$spitens=0;
										foreach($pedidos as $pedido):  
										?>
										<tr>
											<td  scope="col"><?php echo $pedido->produto; ?></td> 
											<td onclick="alterarquantidade('idquant<?php echo $i?>','<?php echo $pedido->id_venda?>','<?php echo $pedido->quantidade; ?>','<?php echo $pedido->venda; ?>')" id="idquant<?php echo $i?>" > <?php echo $pedido->quantidade; ?></td>
											<td scope="col"> <?php echo number_format($pedido->unitario,2,',','.'); ?></td>  
											<td scope="col"> <?php echo  number_format($pedido->valor,2,',','.'); ?></td>  
											<td scope="col"> <?php echo $pedido->funcionario; ?></td>
											<td scope="col"> <a href="#" class='aexcluir' onclick="excluiritem(<?php echo $pedido->id_venda; ?>,<?php echo $pedido->venda; ?>)">EXCLUIR</td>
										<tr>
										<?php 
										$i=$i+1;
										$spvalor = $spvalor + $pedido->valor;
										$spitens = $spitens + $pedido->quantidade;
										endforeach;  
										?>
									</tbody>
								</table>
						</div>
					</div>
					<div  class="col-3">
						<div id='vertotal'  >
							<label class='vertotallabel'> TOTAL DE ITENS  <span id="qtdetotal" name="qtdetotal"><?php echo $spitens;?> </span> </label>
							<br>
							<label class='vertotallabel'> TOTAL DA VENDA  R$ <span id="valorreal" name="valorreal"><?php echo number_format($spvalor,2,',','.');?></span></label>
							<input type="hidden" name="hdvalorreal" id="hdvalorreal" value='<?php echo number_format($spvalor,2,',','.');?>'>
							<br>
							<label class='vertotallabel'> TROCO R$ <span id="valortroco" name="valortroco">0,00</span> </label>
							<br>
							<input type='hidden' id='total' name='total' />
							
							<label class='vertotallabel'>TIPO PAGAMENTO 
								<select id="seltipo" name="seltipo" onchange='Dinheiro()'>
									<option > </option>
									<option value='cartao'> CARTÃO </option>
									<option value='debito'> DEBITO </option>
									<option value='dinheiro'> DINHEIRO </option>
								</select>
							</label>
							<br>
							<label class='vertotallabel'>
							<input  type="text" id='dintotal' name='dintotal' disabled onKeyUp="mascaraMoeda(),calcularvalor(this)" />
							</label>
							<br>
							<div class="text-center">
								<button type="button" class="btn btn-danger btn-block"> Fechar </button>
							</div>							
						</div>					
				</div>
				<div class="col-3">
					<a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/sair">Sair</a>
				</div>
				<div class="col-3">
					<a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/pedido/limparpedido/<?php echo $idvenda; ?>">Limpar Pedido</a>
				</div>
			</div>		
	</body>



</html>
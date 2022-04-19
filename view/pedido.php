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

define('titulo', "Tela de Venda");  
$idvenda = date('ymdHis').rand(100,999);
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
      #pesquisa{border:1px solid #000000;padding:10px;}
	  #itens,#total{border:1px solid #000000;padding:5px;}
	  #vertotal{border:1px solid #000000;padding:5px;}
	  .vertotallabel{padding-bottom:5px;}	  
	  #quant{width: 80px;}
	  #nome_prod{width: 480px;}
	  #principal{border:1px solid #000000;padding:5px;height: 100%;}

	</style>
	<script>
		function autocompletar(){
			var nome = document.getElementById('nome_prod').value;
			if(nome != ""){
				fetch('./produto/buscaproduto/'+nome)
				.then(response => response.text())
				.then(texto => document.getElementById('popup').innerHTML = texto)
			}
		}
		function PegaTexto(texto){
			var frmtexto = document.getElementById('texto'+texto).value;
			document.getElementById('nome_prod').value = frmtexto
			document.getElementById('popup').innerHTML = '';
		}
		function Dinheiro(){ 		
			if(document.getElementById('seltipo').value == 'dinheiro'){
				document.getElementById('dintotal').disabled=false;
				document.getElementById('dintotal').focus();
				
			}else{
				document.getElementById('dintotal').disabled=true;
			}
		}
		

		String.prototype.reverse = function(){
		  return this.split('').reverse().join(''); 
		};

		function mascaraMoeda(campo,evento){
		  var tecla = (!evento) ? window.event.keyCode : evento.which;
		  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
		  var resultado  = "";
		  var mascara = "##.###.###,##".reverse();
		  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
			if (mascara.charAt(x) != '#') {
			  resultado += mascara.charAt(x);
			  x++;
			} else {
			  resultado += valor.charAt(y);
			  y++;
			  x++;
			}
		  }
		  campo.value = resultado.reverse();
		}
	</script>
  </head>
	<body>
		 <div class="container">
				<div id='principal' class="row"  style="height: 100%;">
					
					<div class="row">
						<div class="col-7">
							<label class='h2'>
								Pedido N° <?php echo $idvenda;?>
							</label>
						</div>
						<div class="col-5">
								<label for="buscvenda">Busca venda:</label>
								<input type='hidden' id='idvenda' name='idvenda' value='<?php echo $idvenda;?>' />
								<input type='text' id='buscavenda' name='buscavenda' style='width:200px;' />
								<button type='button'>Buscar</button>
								<label ></label>
								<label for="cliente">Cliente:</label>
								<select id="id_cliente" name="id_cliente">
									<option value="0">Padrão</option>
								</select>
						
						</div>
						
					</div>
					<div class="col-9">
						<div id='pesquisa'>
							<label> Produto </label>
							<input type='text' name='nome_prod' id='nome_prod' onkeyup='autocompletar()'/>							
							<label> Quantidade </label>
							<input type='number' name='quant' id='quant'  />
							<button type="button"> INCLUIR </button>
						</div>
						<div class="dropdown">
							<span id="popup"></span>
						</div>
						<div id='itens'>
								<table  class="table table-striped table-hover">
									<thead>
										<tr > <th  scope="col">Produto</th> <th scope="col"> Quantidade</th>  <th scope="col"> Valor Unitário</th>  <th scope="col"> Valor</th> <tr>
									</thead>
									<tbody>
										<tr> <td  scope="col">Produto</td> <td scope="col"> 2</td> <td scope="col"> 10,00</td>  <td scope="col"> 20,00</td> </tr>
										<tr> <td  scope="col">Produto</td> <td scope="col"> 2</td> <td scope="col"> 10,00</td>  <td scope="col"> 20,00</td> </tr>
										<tr> <td  scope="col">Produto</td> <td scope="col"> 2</td> <td scope="col"> 10,00</td>  <td scope="col"> 20,00</td> </tr>
										<tr> <td  scope="col">Produto</td> <td scope="col"> 2</td> <td scope="col"> 10,00</td>  <td scope="col"> 20,00</td> </tr>
									</tbody>
								</table>
						</div>
					</div>
					<div  class="col-3">
						<div id='vertotal'  >
							<label class='vertotallabel'> TOTAL DE ITENS  0 </label>
							<br>
							<label class='vertotallabel'> TOTAL DA VENDA  R$ 0,00 </label>
							<br>
							<br>
							<label class='vertotallabel'>
							<input type='text' id='dintotal' name='dintotal' disabled value='0,00' onKeyUp="mascaraMoeda(this, event)" />
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
			</div>		
	</body>
</html>
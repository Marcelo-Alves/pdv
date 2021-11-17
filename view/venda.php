<?php
define('titulo', "Tela de Venda");  
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
	  #itens,#total,#principal{border:1px solid #000000;padding:5px;}
	  #vertotal{border:1px solid #000000;padding:5px;}
	  .vertotallabel{padding-bottom:5px;}	  
	  #quant{width: 80px;}
	  #nome_prod{width: 500px;}
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
				<div id='principal' class="row">
					<p class="h1">VENDA</p>
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
							<label class='vertotallabel'> TROCO R$ 0,00 </label>
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
							<input type='text' id='dintotal' name='dintotal' disabled value='0,00' onKeyUp="mascaraMoeda(this, event)" />
							</label>
							<br>
							<div class="text-center">
								<button type="button" class="btn btn-danger btn-block"> Fechar </button>
							</div>							
						</div>					
				</div>
			</div>
		</div>
		<div id='produto'></div>
	</body>
</html>
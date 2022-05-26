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
define('titulo', "Tela de Pedido");  

$idvenda = (isset($_POST['pedido'])?$_POST['pedido']:"01");
include_once('./controller/cliente.php') ;
include_once('./controller/funcionario.php') ;
$clientes = cliente::lista();
$funcionarios = funcionario::lista();


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
	<script src='<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/js/fetchgenerico.js'></script>
	<script>
		function autocompletar(){
			const nome = document.getElementById('nome_prod').value;
			if(nome != ""){
				const dados = 'nome='+nome;
				const popup = document.getElementById('popup');
				const ul = document.createElement('ul');
				ul.setAttribute("class","list-group position-fixed");
				fetchGenerico('../produto/buscaproduto',dados)
				.then(response => response.json())
				.then(response =>  response.map(produto => {					
					const li = document.createElement('li');
					li.setAttribute("class","list-group-item list-group-item-action");
					li.setAttribute("onclick","PegaTexto('"+produto.id_produto+"','"+produto.valor_venda+"','"+produto.nome+"')");
					li.innerHTML = produto.id_produto + ' - ' + produto.nome;
					ul.append(li)
				}));
				popup.append(ul);
			}
		}
		function PegaTexto(id_prod,valor,texto){
			document.getElementById('nome_prod').value = texto;
			document.getElementById('id_produto').value = id_prod;
			document.getElementById('valor_venda').value = valor.replace('.',',');
			
			document.getElementById('popup').innerHTML = '';
			document.getElementById('quant').focus;
		}

		function CarregaProduto(){}


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

		function inseririten(){
			let itenstotal = 0;
			let valorreal = 0;
			const id_produto = document.getElementById('id_produto').value;
			const id_funcionario = document.getElementById('id_funcionario').value;
			const id_cliente = document.getElementById('id_cliente').value;
			const id_venda = document.getElementById('id_venda').value;
			const valor_venda = document.getElementById('valor_venda').value.replace(',','.');			
			const qtde = document.getElementById('quant').value;

			const dados = new URLSearchParams({'id_produto': id_produto,'id_venda': id_venda,'valor_venda':valor_venda,
				'id_funcionario': id_funcionario,'id_cliente': id_cliente,'qtde': qtde});

			fetchGenerico('../pedido/inserir',dados)
				.then(response => response.json())
				.then(response => response.map(itens => {
					if(itens.erro != 'vazio'){

						const tabela = document.getElementById('produto_corpo');
						const tr = document.createElement('tr');
						const tdproduto = document.createElement('td');
						const tdquant = document.createElement('td');
						const tdvunitario = document.createElement('td');
						const tdvenda = document.createElement('td');
						const tdvendedor = document.createElement('td');
						const tdexcluir = document.createElement('td');

						tdproduto.innerHTML=itens.produto;
						tdquant.innerHTML=itens.quantidade;
						tdvunitario.innerHTML=itens.unitario;
						tdvenda.innerHTML=itens.valor;
						tdvendedor.innerHTML=itens.funcionario;
						//tdexcluir.innerHTML=itens.produto;

						tr.appendChild(tdproduto);
						tr.appendChild(tdquant);
						tr.appendChild(tdvunitario);
						tr.appendChild(tdvenda);
						tr.appendChild(tdvendedor);
						tabela.append(tr);

						itenstotal = itenstotal + itens.quantidade;
						valorreal = valorreal + itens.valor;

					}
				}));

				document.getElementById('qtdetotal').innerHTML=itenstotal;
				document.getElementById('valorreal').innerHTML=valorreal;

		}

	</script>
  </head>
	<body  class="pt-0">
		 <div class="container">
				<h1 class="display-2 text-center">PEDIDO</h1>
				<div id='principal' class="row">
					
							<label class='h2'>
								VENDA N° <?php echo $idvenda;?>
							</label>
						
					<div class="row">
						<div class="col-4 mb-2">
								<input type='hidden' id='idpedido' name='idpedido' value='<?php echo $idvenda;?>'/>
								<input type='text' id='buscapedido' name='buscapedido' style='width:200px;'   placeholder="Pedido"/>
								<button type='button'>Buscar</button>
						</div>
						<div class="col-4 mb-2">
								<select id="id_funcionario" name="id_funcionario">
								<option  value="" disabled selected hidden>Funcionário</option>
									<?php
										foreach($funcionarios as $funcionario):
											echo "<option value='".$funcionario->id_funcionario."'>".$funcionario->nome."</option>";
										endforeach;
									?>
								</select>
						</div>
						<div class="col-4 mb-2">
								
								<select id="id_cliente" name="id_cliente">
								<option  value="" disabled selected hidden>Cliente</option>
								<?php
										foreach($clientes as $cliente):
											echo "<option value='".$cliente->id_cliente."'>".$cliente->nome."</option>";
										endforeach;
									?>
								</select>
						</div>
						
					</div>
					<div class="col-9">
						<div id='pesquisa'>
							<label> Produto </label>
							<input type='text' name='nome_prod' id='nome_prod' onkeyup='autocompletar()' placeholder="Produto ou Ean"/>							
							<input type="hidden" name="id_produto" id="id_produto" >
							<input type="hidden" name="id_venda" id="id_venda" value="<?php echo $idvenda; ?>" >
							<input type="hidden" name="valor_venda" id="valor_venda" >
							<label> Quantidade </label>
							<input type='number' name='quant' id='quant'  />
							<button type="button" onclick="inseririten()"> INCLUIR </button>
						</div>
						<div class="dropdown">
							<span id="popup"></span>
						</div>
						<div id='itens'>
								<table  class="table table-striped table-hover">
									<thead>
										<tr > <th  scope="col">Produto</th> <th scope="col"> Quantidade</th>  <th scope="col"> Valor Unitário</th>  <th scope="col"> Valor</th>  <th scope="col"> Vendedor</th><tr>
									</thead>
									<tbody id='produto_corpo'>
										
									
									</tbody>
								</table>
						</div>
					</div>
					<div  class="col-3">
						<div id='vertotal'  >
							<label class='vertotallabel'> TOTAL DE ITENS  <span id="qtdetotal"></span> </label>
							<br>
							<label class='vertotallabel'> TOTAL DA VENDA  R$ <span id="valorreal"></span></label>
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
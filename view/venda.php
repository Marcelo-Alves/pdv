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
				const dropdown = document.getElementsByClassName('dropdown');
				const popup = document.getElementById('popup');
				const ul = document.createElement('ul');
				popup.innerHTML ='';
				ul.setAttribute("class","list-group position-fixed");
				fetchGenerico('../produto/buscaproduto',dados)
				.then(response => response.json())
				.then(response =>  response.map(produto => {	
					if(nome.length <= 1 || produto.erro == "vazio" || produto.erro == undefined){
						alert(nome.length + " - "+produto.erro);
						popup.innerHTML ='';
						return false;
					}				
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

		let itenstotal = 0;
		let valorreal = 0.00;


		function inseririten(){
			
			const id_produto = document.getElementById('id_produto').value;
			const id_funcionario = document.getElementById('id_funcionario').value;
			const id_cliente = document.getElementById('id_cliente').value;
			const id_venda = document.getElementById('id_venda').value;
			const valor_venda = document.getElementById('valor_venda').value.replace(',','.');			
			const qtde = document.getElementById('quant').value;

			if(id_funcionario == ""){
				alert('Selecione um Vendedor');
				document.getElementById('id_funcionario').style.backgroundColor = "#FF0000";
				return false;
			}


			const dados = new URLSearchParams({'id_produto': id_produto,'id_venda': id_venda,'valor_venda':valor_venda,
				'id_funcionario': id_funcionario,'id_cliente': id_cliente,'qtde': qtde});

			fetchGenerico('../pedido/inserir',dados)
				.then(response => response.json())
				.then(response => carregatabelaitens(response));

			document.getElementById('qtdetotal').innerHTML=itenstotal;
			document.getElementById('valorreal').innerHTML=valorreal;
			document.getElementById('nome_prod').value = "";
			document.getElementById('id_produto').value = 1;
		}

		function carregatabelaitens(linhas){
			let i=0;
			const tabela = document.getElementById('produto_corpo');
			tabela.innerHTML='';
			linhas.map(itens => {
					if(itens.erro != 'vazio'){

						const tr = document.createElement('tr');
						const tdproduto = document.createElement('td');
						const tdquant = document.createElement('td');
						const tdvunitario = document.createElement('td');
						const tdvenda = document.createElement('td');
						const tdvendedor = document.createElement('td');
						const tdexcluir = document.createElement('td');

						tdquant.setAttribute('onclick','alterarquantidade("idquant'+i+'","'+itens.id_venda+'","'+itens.quantidade+'")');

						tdproduto.innerHTML=itens.produto;
						tdquant.innerHTML=itens.quantidade;
						tdquant.id = 'idquant'+i;
						tdquant.name = 'idquant'+i;
						tdvunitario.innerHTML=itens.unitario;
						tdvenda.innerHTML=itens.valor;
						tdvendedor.innerHTML=itens.funcionario;
						
						tr.appendChild(tdproduto);
						tr.appendChild(tdquant);
						tr.appendChild(tdvunitario);
						tr.appendChild(tdvenda);
						tr.appendChild(tdvendedor);
						tabela.append(tr);

						itenstotal = parseInt(itenstotal + itens.quantidade);
						valorreal = parseFloat(valorreal + itens.valor);
						i=i+1;
					}
				})
		}

		function alterarquantidade(id,id_venda,quantidade){

			const hiddenid_venda = document.createElement('input');
			const inputquantidade = document.createElement('input');
			const button = document.createElement('button');
			const trocaquantidade = document.getElementById(id);
			trocaquantidade.innerHTML="";

			hiddenid_venda.type='hidden';
			inputquantidade.type='number';
			hiddenid_venda.value = id_venda;
			inputquantidade.value = quantidade;
			hiddenid_venda.id = "quantid_venda";
			hiddenid_venda.name = "quantid_venda";
			inputquantidade.id = "quantquantidade";
			inputquantidade.name = "quantquantidade";
			inputquantidade.setAttribute('style','width:50px');
			button.innerHTML='Alterar';

			trocaquantidade.append(hiddenid_venda);
			trocaquantidade.append(inputquantidade);
			trocaquantidade.append(button);

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
								<input type='text' id='buscapedido' name='buscapedido' style='width:200px;' class="form-control"   placeholder="Pedido"/>
								<button type='button' >Buscar</button>
						</div>
						<div class="col-4 mb-2">
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
						<div class="col-4 mb-2">
								
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
										<tr>
									</thead>
									<tbody id='produto_corpo'>
									</tbody>
								</table>
						</div>
					</div>
					<div  class="col-3">
						<div id='vertotal'  >
							<label class='vertotallabel'> TOTAL DE ITENS  <span id="qtdetotal" name="qtdetotal"></span> </label>
							<br>
							<label class='vertotallabel'> TOTAL DA VENDA  R$ <span id="valorreal" name="qtdetotal"></span></label>
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
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
	  .aexcluir{font-size: 40px; text-decoration: none;  color: #000000;  margin: 0;   padding: 0;}
	  #valorreal{font-weight: bold;}
	  #qtdetotal{font-weight: bold;}

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
					if(nome.length <= 1 || produto.erro == "vazio" ){
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

			document.getElementById('nome_prod').value = "";
			document.getElementById('quant').value = 1;
		}

		function carregatabelaitens(linhas){
			let i=0;
			let itenstotal = 0;
			let valorreal = 0.00;
			const tabela = document.getElementById('produto_corpo');
			const spvalor = document.getElementById('valorreal');
			const spitens = document.getElementById('qtdetotal');
			spvalor.innerHTML='';
			spitens.innerHTML='';
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
					const aexcluir = document.createElement('a');

					tdquant.setAttribute('onclick','alterarquantidade("idquant'+i+'","'+itens.id_venda+'","'+itens.quantidade+'","'+itens.venda+'")');

					tdproduto.innerHTML=itens.produto;
					tdquant.innerHTML=itens.quantidade;
					tdquant.id = 'idquant'+i;
					tdquant.name = 'idquant'+i;
					tdvunitario.innerHTML=itens.unitario.toLocaleString('pt-br', {minimumFractionDigits: 2});
					tdvenda.innerHTML=itens.valor.toLocaleString('pt-br', {minimumFractionDigits: 2});
					tdvendedor.innerHTML=itens.funcionario;
					aexcluir.innerHTML='-';
					aexcluir.setAttribute('class','aexcluir');
					aexcluir.setAttribute('onclick','excluiritem('+itens.id_venda+','+itens.venda+')')
					tdexcluir.appendChild(aexcluir);
					
					tr.appendChild(tdproduto);
					tr.appendChild(tdquant);
					tr.appendChild(tdvunitario);
					tr.appendChild(tdvenda);
					tr.appendChild(tdvendedor);
					tr.appendChild(tdexcluir);
					tabela.append(tr);

					itenstotal = parseInt(itenstotal) + parseInt(itens.quantidade);
					valorreal = parseFloat(valorreal) + parseFloat(itens.valor);
					i=i+1;
				}
			})
			spitens.innerHTML = itenstotal;			
			spvalor.innerHTML = valorreal.toLocaleString('pt-br', {minimumFractionDigits: 2});
			
		}

		function alterarquantidade(id,id_venda,quantidade,venda){

			const hiddenid_venda = document.createElement('input');
			const hidden_venda = document.createElement('input');
			const inputquantidade = document.createElement('input');
			const button = document.createElement('button');
			const trocaquantidade = document.getElementById(id);
			trocaquantidade.innerHTML="";

			hiddenid_venda.type='hidden';
			hidden_venda.type='hidden';
			inputquantidade.type='number';
			hiddenid_venda.value = id_venda;
			hidden_venda.value = venda;
			inputquantidade.value = quantidade;
			hiddenid_venda.id = "quantid_venda";
			hidden_venda.id = "quant_venda";
			hidden_venda.name = "quant_venda";
			hiddenid_venda.name = "quantid_venda";
			inputquantidade.id = "quantquantidade"+id_venda;
			inputquantidade.name = "quantquantidade"+id_venda;
			inputquantidade.setAttribute('style','width:50px');
			button.innerHTML='Alterar';
			button.setAttribute("onclick","gravaralterar("+id_venda+",quantquantidade"+id_venda+","+venda+")")

			trocaquantidade.append(hiddenid_venda);
			trocaquantidade.append(hidden_venda);
			trocaquantidade.append(inputquantidade);
			trocaquantidade.append(button);
			document.getElementById(id).setAttribute("onclick","");
			

		}
		
		function gravaralterar(id_venda,quantidade,venda){
			
			const dados = new URLSearchParams({'id_venda': id_venda,'qtde': quantidade.value,'venda': venda});
			
			fetchGenerico('../pedido/alteraprodutopedido',dados)
				.then(response => response.json())
				.then(response => carregatabelaitens(response));
		}

		function excluiritem(id_venda,venda){
			const dados = new URLSearchParams({'id_venda': id_venda,'venda': venda});
			let excluir = confirm('Deseja excluir?');
			
			fetchGenerico('../pedido/excluiritem',dados)
				.then(response => response.json())
				.then(response => carregatabelaitens(response));
		}


	</script>

  </head>
	<body  class="pt-0">
		 <div class="container">
				<h1 class="display-2 text-center">PEDIDO</h1>
				<div id='principal' class="row">
					
					<div class="row h2">
						VENDA N° <?php echo $idvenda;?>
					</div>
						
					<div class="row">
						<div class="col-4">
							<div class="row">	
								<input type='hidden' id='idpedido' name='idpedido' value='<?php echo $idvenda;?>'/>
								<input type='text' id='buscapedido' name='buscapedido' style='width:200px;' class="form-control"   placeholder="Pedido"/>
								<button type='button' style="width:70px;margin-left: 10px">Buscar</button>
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
											<td scope="col"> <a href="#" class='aexcluir' onclick="excluiritem(<?php echo $pedido->id_venda; ?>,<?php echo $pedido->venda; ?>)">-</td>
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
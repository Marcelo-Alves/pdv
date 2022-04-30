<?php
define('titulo', "Painel de Lista de Produto");    
require 'padrao/topo.php';

$listas = produto::lista();
$categorias = produto::buscacategorias();
$fornecedores = produto::buscafornecedores();
//print_r($listas);
?>
<style>
	#produto{
		border:1px solid #000000;
	}
</style>

<p class="h1">LISTA DE PRODUTO</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col" >Fornecedor</th>
			<th scope="col" >Categoria</th>
			<th scope="col" >Produto</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td scope="row">
				<select id="id_fornecedor" name="id_fornecedor"  class="form-control" onchange="document.location.href=this.value">
					<option value="/produto">Escolha uma Fornecedor</option>
					<?php
						foreach($fornecedores as $fornecedor):
					?>
							<option value="/produto/fornecedor/<?php echo $fornecedor->id_fornecedor;?>"><?php echo $fornecedor->nome; ?></option>
					<?php	
						endforeach;
					?>
				</select>
			</td>
				
			<td scope="row">
				<select id="categoria" name="categoria"  class="form-control" onchange="document.location.href=this.value">
					<option value="/produto">Escolha uma Categoria</option>
					<?php
						foreach($categorias as $categoria):
					?>
							<option value="/produto/categoria/<?php echo $categoria->id_categoria;?>"><?php echo $categoria->nome; ?></option>
					<?php	
						endforeach;
					?>
				</select>
			</td>
			<td scope="row">
				<input type="text" name="nome" id="nome" class="form-control" onkeypress='autocompletar()' >
			</td>
		</tr>
	</tbody>
</table>
<div id="produto" name="produto">
	<table class="table table-striped table-hover">
		<thead> 
			<tr> 
				<th scope="col">id</th>
				<th scope="col">Nome</th>
				<th scope="col">Código Produto</th>
				<th scope="col">Editar</th>
				<th scope="col">Deletar</th>
			</tr>
		</thead>
		<tbody id='tabela_corpo'>
		<?php 
			foreach($listas as $lista):
		?>
			<tr>
				<td scope="row"><?php echo $lista->id_produto ;?></td>
				<td scope="row"><?php echo $lista->nome ;?></td>
				<td scope="row">
					<a href="./ean/<?php echo $lista->id_produto ;?>">
						<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/ean.png" width='45px' > 
					</a>
				</td>
				<td scope="row">
					<a href="./produto/editar/<?php echo $lista->id_produto ;?>">
						<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/editar.png" width='30px' > 
					</a>
				</td>
				<td scope="row">
					<a href="./produto/deletar/<?php echo $lista->id_produto ;?>">
						<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.jpg" width='30px' >  
					</a>
				</td>
			</tr>
		
		<?php
			endforeach;
		?>
		</tbody>
	</table>
</div>
<script>
	function autocompletar(){
		const tabela = document.getElementById('tabela_corpo');
		const prot = window.location.protocol
		const host = window.location.host;
		tabela.innerHTML ="";

		const nome = document.getElementById('nome').value;
		
		const tr = document.createElement('tr');
		const tdid = document.createElement('td');
		const tdnome = document.createElement('td');
		const tdcodigo = document.createElement('td');
		const tdeditar = document.createElement('td');

		const imgean = document.createElement('img');
		imgean.src = prot+"//"+host+'/biblioteca/img/ean.png';
		imgean.setAttribute('width','30px');
		const imgeditar = document.createElement('img');
		imgeditar.src = prot+"//"+host+'/biblioteca/img/editar.png';	
		imgeditar.setAttribute('width','30px');
		const imgdeletar = document.createElement('img');
		imgdeletar.src = prot+"//"+host+'/biblioteca/img/lixeira.jpg';	
		imgdeletar.setAttribute('width','30px');
		const tddeletar = document.createElement('td');
		const acodigo = document.createElement('a');	
		const aeditar = document.createElement('a');		
		const adeletar = document.createElement('a');
		const dados = 'nome='+nome;

		fetchGenerico('produto/buscaproduto',dados)
		.then(response => response.json())
		.then(response => response.map(itens => {
			if(itens.erro !='vazio'){
				tdid.innerHTML     = itens.id_produto;
				tdnome.innerHTML   = itens.nome;

				acodigo.href  = "/ean/"+itens.id_produto;
				aeditar.href  = "produto/editar/"+itens.id_produto;			
				adeletar.href = "produto/deletar/"+itens.id_produto;

				acodigo.append(imgean);
				tdcodigo.append(acodigo);

				aeditar.append(imgeditar);
				tdeditar.append(aeditar);

				adeletar.append(imgdeletar);
				tddeletar.append(adeletar);

				tr.append(tdid);
				tr.append(tdnome);
				tr.append(tdcodigo);
				tr.append(tdeditar);
				tr.append(tddeletar);
				tabela.appendChild(tr);  
			}
			else{
				const trerro = document.createElement('tr');
				const tderro = document.createElement('td');
				tderro.colSpan = 5;
				//tderro.textAlign = "center";
				tderro.innerHTML = "Não existe produto";
				trerro.appendChild(tderro);
				tabela.appendChild(trerro);
			}
		}));
	}

</script>
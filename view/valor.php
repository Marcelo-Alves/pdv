<?php
define('titulo', "Valor produto");
    
require 'padrao/topo.php';

$listas = valor::lista();

?>
<style>
	#produto{
		border:1px solid #000000;
	}
</style>

<p class="h1">LISTA DE VALOR PRODUTO</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col" >Produto</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td scope="row">
				<input type="text" name="produto" id="produto" class="form-control" onkeyup='BuscaProduto()' >
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
				<th scope="col">Valor</th>
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
					<input type="number" name="valor" id="valor">
                    <button>Cadastrar</button>
				</td>
			</tr>
		
		<?php
			endforeach;
		?>
		</tbody>
	</table>
</div>
<script>
	function BuscaProduto(){
		
		const nome = document.getElementById('produto').value;

		if(nome != null){
			const dados = 'nome='+nome;
			fetchGenerico('produto/buscaproduto',dados)
			.then(response => response.json())
			.then(response => popular(response));
		}
	}

	function BuscaFornecedor(){
		
		const fornecedor = document.getElementById('id_fornecedor').value;
		//alert(fornecedor)
		const dados = 'fornecedor='+fornecedor;
		fetchGenerico('produto/Buscafornecedor',dados)
		.then(response => response.json())
		.then(response => popular(response));
	
	}

	function BuscaCategoria(){
		
		const categoria = document.getElementById('categoria').value;		
		const dados = 'categoria='+categoria;
		fetchGenerico('produto/categorias',dados)
		.then(response => response.json())
		.then(response => popular(response));
	}

	function popular(ObjJson) {

		const tabela = document.getElementById('tabela_corpo');
		const prot = window.location.protocol;
		const host = window.location.host;
		tabela.innerHTML = null;

		ObjJson.map(itens => {
			if(itens.erro != 'vazio'){

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

		
				tdid.innerHTML     = itens.id_produto;
				tdnome.innerHTML   = itens.nome;

				acodigo.href  = "/ean/"+itens.id_produto;
				aeditar.href  = "produto/editar/"+itens.id_produto;			
				adeletar.href = "produto/deletar/"+itens.id_produto;

				acodigo.appendChild(imgean);
				tdcodigo.appendChild(acodigo);

				aeditar.appendChild(imgeditar);
				tdeditar.appendChild(aeditar);

				adeletar.appendChild(imgdeletar);
				tddeletar.appendChild(adeletar);

				tr.appendChild(tdid);
				tr.appendChild(tdnome);
				tr.appendChild(tdcodigo);
				tr.appendChild(tdeditar);
				tr.appendChild(tddeletar);
				tabela.appendChild(tr); 
			}
			else{
				const trerro = document.createElement('tr');
				const tderro = document.createElement('td');
				tderro.colSpan = 5;
				tderro.innerHTML = "Não existe produto";
				trerro.appendChild(tderro);
				tabela.appendChild(trerro);
			}
		});
	}

</script>
<?php
    require 'padrao/rodape.php';
?>
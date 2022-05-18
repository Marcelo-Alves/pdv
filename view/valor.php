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
	<tbody>
		<tr>
			<td scope="row">
				<input type="text" name="produto" id="produto" class="form-control" placeholder="Nome Produto" onkeyup='BuscaProduto()' >
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
				<th scope="col">Valor Compra</th>
				<th scope="col">Valor Venda</th>
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
					<input type="number" name="compra" id="compra" style="width: 100px ;" value="<?php echo $lista->valor_compra ;?>">
					<input type="hidden" name="id_produto" id="id_produto" value="<?php echo $lista->id_produto ;?>">
					
				</td>
				<td scope="row">
					<input type="number" name="venda" id="venda"  style="width: 100px ;" value="<?php echo $lista->valor_venda ;?>">
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
			fetchGenerico('valor/buscavalor',dados)
			.then(response => response.json())
			.then(response => popular(response));
		}
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

			
			const imgeditar = document.createElement('img');
			const tddeletar = document.createElement('td');

		
				tdid.innerHTML     = itens.id_produto;
				tdnome.innerHTML   = itens.nome;

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
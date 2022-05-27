<?php
define('titulo', "Painel de Valor de Produto");    
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
			$i=0;
			foreach($listas as $lista):
		?>
			<tr>
				<td scope="row"><?php echo $lista->id_produto ;?></td>
				<td scope="row"><?php echo $lista->nome ;?></td>
				<td scope="row">
					<input type="number" name="compra<?php echo $i;?>" id="compra<?php echo $i;?>" style="width: 100px ;" value="<?php echo $lista->valor_compra ;?>">
					<input type="hidden" name="id_produto<?php echo $i;?>" id="id_produto<?php echo $i;?>" value="<?php echo $lista->id_produto ;?>">
				</td>
				<td scope="row">
					<input type="number" name="venda<?php echo $i;?>" id="venda<?php echo $i;?>"  style="width: 100px ;" value="<?php echo $lista->valor_venda ;?>">
                    <button onclick="CadastrarValor(id_produto<?php echo $i;?>.value,compra<?php echo $i;?>.value,venda<?php echo $i;?>.value)">Cadastrar</button>
				</td>
			</tr>
		<?php
			$i=$i+1;
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
		let i = 0;
		const tabela = document.getElementById('tabela_corpo');
		tabela.innerHTML = null;

		ObjJson.map(itens => {
			if(itens.erro != 'vazio'){

				const tr = document.createElement('tr');
				const tdid = document.createElement('td');
				const tdnome = document.createElement('td');
				const tdcodigo = document.createElement('td');				
				const tdcompra = document.createElement('td');
				const tdvenda = document.createElement('td');
				const tdcadastrar = document.createElement('td');
				const inputcompra = document.createElement('input');
				const inputvenda = document.createElement('input');
				const inputhiddenid = document.createElement('input');
				const buttoncadastrar = document.createElement('button');

				inputcompra.type ='number';
				inputvenda.type ='number';
				inputhiddenid.type ='hidden';
				buttoncadastrar.innerHTML = 'Cadastrar';
				buttoncadastrar.setAttribute('onclick','CadastrarValor(id_produto'+i+'.value,compra'+i+'.value,venda'+i+'.value)');

				inputcompra.id='compra'+i;
				inputcompra.name='compra'+i;
				inputvenda.id='venda'+i;
				inputvenda.name='venda'+i;
				inputhiddenid.id='id_produto'+i;
				inputhiddenid.name='id_produto'+i;
				
				inputcompra.value=itens.valor_compra;
				inputvenda.value=itens.valor_venda;
				inputhiddenid.value= itens.id_produto;
				tdid.innerHTML     = itens.id_produto;
				tdnome.innerHTML   = itens.nome;
				
				tdcompra.appendChild(inputcompra);
				tdcompra.appendChild(inputhiddenid);
				tdvenda.appendChild(inputvenda);
				tdvenda.appendChild(buttoncadastrar);

				tr.appendChild(tdid);
				tr.appendChild(tdnome);
				tr.appendChild(tdcompra);
				tr.appendChild(tdvenda);

				tabela.appendChild(tr); 
				i=i+1;
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

	function CadastrarValor(idproduto,comprar,valor){

		

		if(comprar == "" || valor == ""){

			alert("Por favor, preencha os valores corretamente");
			return false;
		}
		

		const dados = new URLSearchParams({'id_produto': idproduto,'compra': comprar.replace(',','.'),'venda': valor.replace(',','.')});

		fetchGenerico('valor/inserir',dados)
			.then(response => response.json())
			.then(response => response.map(itens => {
				if(itens.erro == 'vazio')
				{
					BuscaProduto();
				}
				else
				{
					alert("Não possivel alterar o valor!");
					BuscaProduto();
				}
			}));
	}

</script>
<?php
    require 'padrao/rodape.php';
?>
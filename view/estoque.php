<?php
define('titulo', "Painel de Lista de Estoque");    
require 'padrao/topo.php';

$listas = estoque::lista();
$categorias = estoque::buscacategorias();
$fornecedores = estoque::buscafornecedores();
/*	echo "<pre>";
print_r($listas);
echo "</pre>";*/
?>
<style>
	#produto{
		border:1px solid #000000;
	}
</style>
<script>
	function autocompletar(){
		var nome = document.getElementById('autocomplete').value;
		fetch('../buscafetch/'+nome)
		.then(response => response.text())
		.then(texto => document.getElementById('estoque').innerHTML = texto)
	}

</script>

<p class="h1">LISTA DE ESTOQUE</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col" >Categoria</th>
			<th scope="col" >Produto</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td scope="row">
				<select id="categoria" name="categoria"  class="form-control" onchange="document.location.href=this.value">
					<option value="/produto">Escolha uma Categoria</option>
					<?php
						foreach($categorias as $categoria):
					?>
							<option value="/estoque/categoria/<?php echo $categoria->id_categoria;?>"><?php echo $categoria->nome; ?></option>
					<?php	
						endforeach;
					?>
				</select>
			</td>
			<td scope="row">
				<input type="text" name="autocomplete" id="autocomplete" class="form-control" onkeypress='autocompletar()' >
			</td>
		</tr>
	</tbody>
</table>
<div id="estoque" name="estoque">
	<table class="table table-striped table-hover">
		<thead> 
			<tr> 
				<th scope="col">id</th>
				<th scope="col">Nome</th>
				<th scope="col">Categoria</th>
				<th scope="col">Lote</th>				
				<th scope="col">Quantidade</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach($listas as $lista):
		?>
			<tr>
				<td scope="row"><a href="./editar/<?php echo $lista->id_estoque?>"><?php echo $lista->id_estoque ;?></a></td>
				<td scope="row"><a href="./editar/<?php echo $lista->id_estoque?>"><?php echo $lista->produto ;?></a></td>
				<td scope="row"><a href="./editar/<?php echo $lista->id_estoque?>"><?php echo $lista->categoria ;?></a></td>
				<td scope="row"><a href="./editar/<?php echo $lista->id_estoque?>"><?php echo $lista->lote ;?></a></td>
				<td scope="row"><a href="./editar/<?php echo $lista->id_estoque?>"><?php echo $lista->quantidade ;?></a></td>
			</tr>		
		<?php
			endforeach;
		?>
		</tbody>
	</table>
</div>
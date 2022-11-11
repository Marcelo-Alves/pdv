<?php
define('titulo', "Painel de Lista de Produto");    
require 'padrao/topo.php';

$listas = produto::categoria();
$categorias = produto::buscacategorias();
$fornecedores = produto::buscafornecedores();
//print_r ($listas);
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
		.then(texto => document.getElementById('produto').innerHTML = texto)
	}

</script>
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
				<input type="text" name="autocomplete" id="autocomplete" class="form-control" onkeypress='autocompletar()' >
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
		<tbody>
		
		<?php 
			foreach($listas as $lista):
		?>
			<td scope="row"><?php echo $lista->id_produto ;?></th>
			<td scope="row"><?php echo $lista->nome ;?></td>	
			<td scope="row">
				<a href="<?php echo$_SERVER['HTTP_REFERER']?>/ean/<?php echo $lista->id_produto ;?>">
					<img src="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/img/ean.png" width='45px' > 
				</a>
			</td>
			<td scope="row">
				<a href="./produto/editar/<?php echo $lista->id_produto ;?>">
					<img src="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/img/editar.png" width='30px' > 
				</a>
			</td>
			<td scope="row">
				<a href="./produto/deletar/<?php echo $lista->id_produto ;?>">
					<img src="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/img/lixeira.png" width='30px' >  
				</a>
			</td>
		</tbody>
		<?php
			endforeach;
		?>
	</table>
</div>

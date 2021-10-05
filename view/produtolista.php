<?php
define('titulo', "Painel de Lista de Produto");    
require 'padrao/topo.php';

$listas = produto::lista();
?>
<p class="h1">LISTA DE PRODUTO</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">id</th>
			<th scope="col">Nome</th>
			<th scope="col">Validade</th>
			<th scope="col">Validade Dias</th>
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
		<td scope="row"><?php echo $lista->validade ;?></td>
		<td scope="row"><?php echo $lista->validade_dias ;?></td>
		<td scope="row">Editar <?php echo $lista->id_produto ;?></td>
		<td scope="row">Deletar <?php echo $lista->id_produto ;?></td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

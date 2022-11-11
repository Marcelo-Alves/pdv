<?php
define('titulo', "Painel de Lista de Categoria");    
require 'padrao/topo.php';

$listas = categoria::lista();
?>
<p class="h1">LISTA DE CATEGORIA</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">id</th>
			<th scope="col">Nome</th>
			<th scope="col">Ativo</th>
			<th scope="col">Editar</th>
			<th scope="col">Deletar</th>
		</tr>
	</thead>
	<tbody>
	
	<?php 
		foreach($listas as $lista):
	?>
		<td scope="row"><?php echo $lista->id_categoria ;?></th>
		<td scope="row"><?php echo $lista->nome ;?></td>
		<td scope="row"><?php echo ($lista->ativo==0?"Não":"Sim");?></td>
		<td scope="row">
			<a href="./categoria/editar/<?php echo $lista->id_categoria ;?>">
				<img src="/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="./categoria/deletar/<?php echo $lista->id_categoria ;?>">
				<img src="/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

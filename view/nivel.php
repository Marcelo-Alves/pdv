<?php
define('titulo', "Painel de Lista de Niveis");    
require 'padrao/topo.php';

$listas = nivel::lista();
?>
<p class="h1">LISTA DE NIVEL</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">Nome</th>
			<th scope="col">Editar</th>
			<th scope="col">Deletar</th
		</tr>
	</thead>
	<tbody>
	
	<?php 
		foreach($listas as $lista):
	?>
		
		<td scope="row"><?php echo $lista->nome ;?></td>		
		<td scope="row">
			<a href="./nivel/editar/<?php echo $lista->id_nivel ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="./nivel/deletar/<?php echo $lista->id_nivel ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

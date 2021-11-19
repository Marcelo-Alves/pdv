<?php
define('titulo', "Painel de Lista de Fornecedores");    
require 'padrao/topo.php';

$listas = fornecedor::lista();
?>
<p class="h1">LISTA DE FORNECEDORES</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">id</th>
			<th scope="col">Nome</th>
			<th scope="col">CNPJ</th>
			<th scope="col">Editar</th>
			<th scope="col">Deletar</th>
		</tr>
	</thead>
	<tbody>
	
	<?php 
		foreach($listas as $lista):
	?>
		<td scope="row"><?php echo $lista->id_fornecedor ;?></th>
		<td scope="row"><?php echo $lista->nome ;?></td>
		<td scope="row"><?php echo $lista->cnpj;?></td>
		<td scope="row">
			<a href="./fornecedor/editar/<?php echo $lista->id_fornecedor ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="./fornecedor/deletar/<?php echo $lista->id_fornecedor ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

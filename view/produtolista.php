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
		<td scope="row"><?php echo ($lista->validade==0?"Não":"Dias");?></td>
		<td scope="row"><?php echo $lista->validade_dias ;?></td>
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
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.png" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

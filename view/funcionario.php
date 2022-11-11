<?php
define('titulo', "Painel de Lista de Niveis");    
require 'padrao/topo.php';

$listas = Funcionario::lista();
/*echo "<pre>";
print_r($listas);
echo "</pre>";*/
?>
<p class="h1">LISTA DE FUNCIONÁRIO</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">Nome</th>
			<th scope="col">email</th>
			<th scope="col">CPF</th>
			<th scope="col">Nivel</th>
			<th scope="col">Editar</th>
			<th scope="col">Deletar</th>
		</tr>
	</thead>
	<tbody>
	
	<?php 
		foreach($listas as $lista):
	?>		
		<td scope="row"><?php echo $lista->nome ;?></td>		
		<td scope="row"><?php echo $lista->email ;?></td>
		<td scope="row"><?php echo $lista->cpf ;?></td>
		<td scope="row"><?php echo $lista->nivel ;?></td>
		<td scope="row">
			<a href="funcionario/editar/<?php echo $lista->id_funcionario ;?>">
				<img src="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="deletar/<?php echo $lista->io ;?>">
				<img src="<?php echo$_SERVER['HTTP_REFERER']?>/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>

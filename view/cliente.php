<?php
define('titulo', "Painel de Cliente");    
require 'padrao/topo.php';

$listas = cliente::lista();
/*echo "<pre>";
print_r($listas);
echo "</pre>";*/
?>
<p class="h1">LISTA DE CLIENTE</p>
<hr>
<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">Nome</th>
			<th scope="col">Email</th>
			<th scope="col">CPF</th>	
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
		<td scope="row">
			<a href="cliente/editar/<?php echo $lista->id_cliente ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="cliente/deletar/<?php echo $lista->id_cliente ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
	</tbody>
	<?php
		endforeach;
	?>
</table>
<script src="./biblioteca/js/fetchgenerico.js"></script>
<script>
	function busca_cliente(){
		fetchGenericoTudo('cliente')
		.then(resposta => resposta.json())
		.then(retorno => console.log(retorno))
	}

</script>
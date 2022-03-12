<?php
define('titulo', "Painel de Alterar de Categoria");    
require 'padrao/topo.php';
$categorias = categoria::editar();
foreach($categorias as $categoria):
	$id_categoria = $categoria->id_categoria;
	$nome = $categoria->nome;
	$ativo = $categoria->ativo;
endforeach;
?>

<p class="h1">ALTERAR CATEGORIA</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $id_categoria; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>">	
			<br>
			<label for="ativo" > Ativo </label>		
			<select name='ativo' class="form-control">
				<option selected>Escolher...</option>
				<option value='0' <?php echo ($ativo == 0?"selected":"");?> >Não</option>
				<option value='1' <?php echo ($ativo == 1?"selected":"");?> >Sim</option>
			<select/>
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>


<?php
require 'padrao/rodape.php';
?>

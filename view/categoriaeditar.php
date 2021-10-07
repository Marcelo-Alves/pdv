<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
$produtos = produto::editar();
foreach($produtos as $produto):
	$id_produto = $produto->id_produto;
	$nome = $produto->nome;
	$validade = $produto->validade;
	$validade_dias = $produto->validade_dias;
endforeach;
?>

<p class="h1">ALTERAR PRODUTO</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>">	
			<br>
			<label for="validade" > Validade </label>		
			<select name='validade' class="form-control">
				<option selected>Escolher...</option>
				<option value='0' <?php echo ($validade == 0?"selected":"");?> >Não</option>
				<option value='1' <?php echo ($validade == 1?"selected":"");?> >Sim</option>
			<select/>
			<br>
			<label for="validade_dias" >Validade em dias </label>			
			<input type='text' name='validade_dias' id='validade_dias' class="form-control" value="<?php echo $validade_dias ?>">
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>


<?php
require 'padrao/rodape.php';
?>
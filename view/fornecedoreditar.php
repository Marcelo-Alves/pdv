<?php
define('titulo', "Painel de Alterar Fornecedor");    
require 'padrao/topo.php';

$fornecedores = fornecedor::editar();

foreach($fornecedores as $fornecedor):
	$id_fornecedor = $fornecedor->id_fornecedor;
	$nome = $fornecedor->nome;
	$cnpj = $fornecedor->cnpj;
endforeach;
?>

<p class="h1">ALTERAR FORNECEDOR</p>
<hr>
	<form action='./alterar' method='POST'>
		<div class="form-group">
			<input type="hidden" name="id_fornecedor" id="id_fornecedor" value="<?php echo $id_fornecedor; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>">	
			<br>
			<label for="nome" > CNPJ </label>
			<input type='text' name='cnpj' id='cnpj' class="form-control" value="<?php echo $cnpj ?>">	
			<br>
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

<?php
require 'padrao/rodape.php';
?>

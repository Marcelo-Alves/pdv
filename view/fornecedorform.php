<?php
define('titulo', "Painel de Cadastro de Fornecedor");    
require 'padrao/topo.php';
?>
<p class="h1">CADASTRO DE FORNECEDOR</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control">	
			<br>
			<label for="nome" > CNPJ </label>
			<input type='text' name='cnpj' id='cnpj' class="form-control">	
			<br>
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Cadastrar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>
<?php
require 'padrao/rodape.php';
?>
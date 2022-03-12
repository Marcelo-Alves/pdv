<?php
define('titulo', "Painel de Cadastro de Categoria");    
require 'padrao/topo.php';
?>
<p class="h1">CADASTRO DE CATEGORIA</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control">	
			<br>
			<label for="ativo" > Ativo </label>		
			<select name='ativo' class="form-control">
				<option selected>Escolher...</option>
				<option value='0'>Não</option>
				<option value='1'>Sim</option>
			<select/>
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Cadastrar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>
<?php
require 'padrao/rodape.php';
?>
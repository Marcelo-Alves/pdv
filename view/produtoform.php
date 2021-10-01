<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
?>

<p class="h1">CADASTRO DE PRODUTO</p>
<hr>
	<form action='controller/produto.php?action=inserir' method='POST'>
		<div class="form-group">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control">	
			<br>
			<label for="validade" > Validade </label>		
			<select name='validade' class="form-control">
				<option selected>Escolher...</option>
				<option value='0'>Não</option>
				<option value='1'>Sim</option>
			<select/>
			<br>
			<label for="validade_dias" >Validade em dias </label>			
			<input type='text' name='validade_dias' id='validade_dias' class="form-control">
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Cadastrar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>


<?php
require 'padrao/rodape.php';
?>

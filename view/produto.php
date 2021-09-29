<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
?>
<label>CADASTRO DE PRODUTO</LABEL>
<form action='controller/produto.php?action=inserir' method='POST'>
	nome
	<input type='text' name='nome' id='nome' class="form-control">
	<br>
	Validade
	<select name='validade' class="form-control">
		<option value='0'>Não</option>
		<option value='1'>Sim</option>
	<select >
	<br>	
	Validade em dias
	<input type='text' name='validade_dias' id='validade_dias' class="form-control">
	<br>
	<input type='SUBMIT' VALUE='Cadastrar'  class="form-control">
	<br>
</form>

<?php
require 'padrao/rodape.php';
?>

<?php
define('titulo', "Painel de Alterar Nivel");    
require 'padrao/topo.php';
?>

<p class="h1">NOVO NIVEL</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" >	
			<br>
			<table>
				<tr>
					<td>
						<label for="">Tela de Venda</label>
						<input type="checkbox" name="venda" id="venda"  >
					</td>
					<td>
						<label for="">Tela de Estoque</label>
						<input type="checkbox" name="estoque" id="estoque" >
					</td>
					<td>
						<label for="">Tela Cadastro de Produto</label>
						<input type="checkbox" name="produto" id="produto" value="">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Usuário</label>
						<input type="checkbox" name="usuario" id="usuario" >						
					</td>
					<td>
						<label for="">Tela de Fornecedor</label>
						<input type="checkbox" name="fornecedor" id="fornecedor" >
					</td>
					<td>
						<label for="">Tela Empresa</label>
						<input type="checkbox" name="empresa" id="empresa" >

					</td>
				</tr>
			</table>
			
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='NOVO' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>


<?php
require 'padrao/rodape.php';
?>


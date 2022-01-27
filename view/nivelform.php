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
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Tela de Caixa</label>
					</td>
					<td>
						<input type="checkbox" name="caixa" id="caixa">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Venda</label>
					</td>
					<td>
						<input type="checkbox" name="venda" id="venda" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Estoque</label>
					</td>
					<td>
						<input type="checkbox" name="estoque" id="estoque" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Produto</label>
					</td>
					<td>
						<input type="checkbox" name="produto" id="produto">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Usuário</label>
					</td>
					<td>
						<input type="checkbox" name="usuario" id="usuario">						
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Fornecedor</label>
					</td>
					<td>
						<input type="checkbox" name="fornecedor" id="fornecedor">
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Empresa</label>
					</td>
					<td>
						<input type="checkbox" name="empresa" id="empresa" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Relatório</label>
					</td>
					<td>
						<input type="checkbox" name="relatorio" id="relatorio" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Sangria</label>
					</td>
					<td>
						<input type="checkbox" name="sangria" id="sangria" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Excluir Item</label>
					</td>
					<td>
						<input type="checkbox" name="excluir_item" id="empresa" >
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


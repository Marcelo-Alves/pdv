<?php
define('titulo', "Painel de Alterar Nivel");    
require 'padrao/topo.php';

?>

<p class="h1">NOVO NIVEL</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" required>	
			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Painel</label>
					</td>
					<td>
						<input type="checkbox" name="painel" id="painel">
					</td>
				</tr>
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
						<label for="">Tela Cadastro de Cliente</label>
					</td>
					<td>
						<input type="checkbox" name="cliente" id="cliente" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Nivel</label>
					</td>
					<td>
						<input type="checkbox" name="nivel" id="nivel">
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
						<label for="">Tela Cadastro de Categoria</label>
					</td>
					<td>
						<input type="checkbox" name="categoria" id="categoria">
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
						<label for="">Tela de Funcionário</label>
					</td>
					<td>
						<input type="checkbox" name="funcionario" id="funcionario">
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
						<label for="">Excluir Item da Venda</label>
					</td>
					<td>
						<input type="checkbox" name="excluir_item" id="excluir_item" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Desconto</label>
					</td>
					<td>
						<input type="checkbox" name="desconto" id="desconto" >
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Valor de Desconto</label>
					</td>
					<td>
						<input type="number" name="valor_desconto" id="valor_desconto" value='0.00' >
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


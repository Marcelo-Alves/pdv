<?php
define('titulo', "Painel de Alterar Nivel");    
require 'padrao/topo.php';
$niveis = nivel::editar();

foreach($niveis as $nivel):
	$id_nivel = $nivel->id_nivel;
	$nome = $nivel->nome;  
	$venda = $nivel->venda ;
	$caixa = $nivel->caixa ;
	$cliente = $nivel->cliente;
	$categoria = $nivel->categoria;
 	$estoque = $nivel->estoque ;
	$produto = $nivel->produto ;
	$usuario = $nivel->usuario ;
	$nivel1 = $nivel->nivel;
	$fornecedor = $nivel->fornecedor ;
	$empresa = $nivel->empresa ;
	$painel = $nivel->painel ;
	$sangria = $nivel->sangria ;
	$relatorio = $nivel->relatorio ;
	$desconto = $nivel->desconto ;
	$valor_desconto = $nivel->valor_desconto ;
	$excluir_item = $nivel->excluir_item ;
endforeach;

?>

<p class="h1">ALTERAR NIVEL</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<input type="hidden" name="id_nivel" id="id_nivel" value="<?php echo $id_nivel; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>" required>	
			<br><table class="table table-striped table-hover">
				<tr><td>
						<label for="">Painel</label>
					</td>
					<td>
						<input type="checkbox" name="painel" id="painel" 
						<?php
							echo $painel == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr><td>
						<label for="">Tela de Caixa</label>
					</td>
					<td>
						<input type="checkbox" name="caixa" id="caixa" 
						<?php
							echo $caixa == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Venda</label>
					</td>
					<td>
						<input type="checkbox" name="venda" id="venda" 
						<?php
							echo $venda == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Estoque</label>
					</td>
					<td>
						<input type="checkbox" name="estoque" id="estoque" 
						<?php
							echo $estoque == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Cliente</label>
					</td>
					<td>
						<input type="checkbox" name="cliente" id="cliente"
						<?php
							echo $cliente == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Nivel</label>
					</td>
					<td>
						<input type="checkbox" name="nivel" id="nivel"
						<?php
							echo $nivel1 == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Produto</label>
					</td>
					<td>
						<input type="checkbox" name="produto" id="produto"
						<?php
							echo $produto == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Categoria</label>
					</td>
					<td>
						<input type="checkbox" name="categoria" id="categoria"
						<?php
							echo $categoria == '1'?'checked':'';
						?>>
					</td>
				</tr>
				
				
				
				<tr>
					<td>
						<label for="">Tela de Usuário</label>
					</td>
					<td>
						<input type="checkbox" name="usuario" id="usuario"
						<?php
							echo $usuario == '1'?'checked':'';
							?>>						
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Fornecedor</label>
					</td>
					<td>
						<input type="checkbox" name="fornecedor" id="fornecedor"
						<?php
							echo $fornecedor == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Empresa</label>
					</td>
					<td>
						<input type="checkbox" name="empresa" id="empresa"
						<?php
							echo $empresa == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Relatório</label>
					</td>
					<td>
						<input type="checkbox" name="relatorio" id="relatorio" 
						<?php
							echo $relatorio == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Sangria</label>
					</td>
					<td>
						<input type="checkbox" name="sangria" id="sangria"
						<?php
							echo $sangria == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Excluir Item</label>
					</td>
					<td>
						<input type="checkbox" name="excluir_item" id="excluir_item" 
						<?php
							echo $excluir_item == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Desconto</label>
					</td>
					<td>
						<input type="checkbox" name="desconto" id="desconto" <?php
							echo $desconto == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Valor de Desconto em porcentagem "%"</label>
					</td>
					<td>
						<input type="number" name="valor_desconto" id="valor_desconto" value="<?php
							echo $valor_desconto;
						?>">
					</td>
				</tr>
			</table>
			
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>


<?php
require 'padrao/rodape.php';
?>


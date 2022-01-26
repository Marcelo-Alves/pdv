<?php
define('titulo', "Painel de Alterar Nivel");    
require 'padrao/topo.php';
$niveis = nivel::editar();

//print_r($niveis);

foreach($niveis as $nivel):
	$id_nivel = $nivel->id_nivel;
	$nome = $nivel->nome;  
	$venda = $nivel->venda ;
	$caixa = $nivel->caixa ;
	$estoque = $nivel->estoque ;
	$produto = $nivel->produto ;
	$usuario = $nivel->usuario ;
	$fornecedor = $nivel->fornecedor ;
	$empresa = $nivel->empresa ;
endforeach;

?>

<p class="h1">ALTERAR NIVEL</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<input type="hidden" name="id_nivel" id="id_nivel" value="<?php echo $id_nivel; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>">	
			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Tela de Caixa</label>
						<input type="checkbox" name="caixa" id="caixa" 
						<?php
							echo $caixa == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Venda</label>
						<input type="checkbox" name="venda" id="venda" 
						<?php
							echo $venda == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Estoque</label>
						<input type="checkbox" name="estoque" id="estoque" 
						<?php
							echo $estoque == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Cadastro de Produto</label>
						<input type="checkbox" name="produto" id="produto"
						<?php
							echo $produto == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Usuário</label>
						<input type="checkbox" name="usuario" id="usuario"
						<?php
							echo $usuario == '1'?'checked':'';
							?>>						
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela de Fornecedor</label>
						<input type="checkbox" name="fornecedor" id="fornecedor"
						<?php
							echo $fornecedor == '1'?'checked':'';
						?>>
					</td>
				</tr>
				<tr>
					<td>
						<label for="">Tela Empresa</label>
						<input type="checkbox" name="empresa" id="empresa"
						<?php
							echo $empresa == '1'?'checked':'';
						?>>

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


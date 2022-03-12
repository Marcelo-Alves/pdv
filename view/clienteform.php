<?php
define('titulo', "Painel Novo Funcionário");    
require 'padrao/topo.php';
?>
<p class="h1">NOVO FUNCIONÁRIO</p>
<hr>
	<form action='./inserir' method='POST' id='frmfuncionario'>
		<div class="form-group">
			
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" required >	
			<br>
			<label for="nome" > Telefone </label>
			<input type='text' name='telefone' id='telefone' required maxlength="14" class="form-control" onkeydown="fMasc(this,mTel);" class="form-control" >	
			<br>
			<label for="nome" > e-mail </label>
			<input type='email' name='email' id='email' class="form-control" required>	
			<br>
			<label for="nome" > CPF </label>
			<input type='text' name='cpf' id='cpf' maxlength="14" onkeydown="fMasc(this,mCPF);" class="form-control" required>	
			<br>
			<label for="nome" > CEP </label>
			<input type='text' name='cep' id='cep'  maxlength="10" onkeydown="fMasc(this,mCEP);"  class="form-control" required >	
			<br>
			<label for="nome" > Rua </label>
			<input type='text' name='rua' id='rua' class="form-control" required >	
			<br>
			<label for="nome" > Número </label>
			<input type='text' name='numero' id='numero' class="form-control" required >	
			<br>
			<label for="nome" > Bairro </label>
			<input type='text' name='bairro' id='bairro' class="form-control" required >	
			<br>
			<label for="nome" > Cidade </label>
			<input type='text' name='cidade' id='cidade' class="form-control" required >	
			<br>
			<label for="nome" > Estado </label>
			<input type='text' name='estado' id='estado' class="form-control" required >				
			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Ativo</label>
					
						<input type="checkbox" name="ativo" id="ativo">
					</td>
					<td>
						<label for="nome" > Limite </label>
						<input type='number' name='limite' id='limite' value='0.00' required >	
					</td>
				</tr>		
			</table>
			
		</div>
		<br>
		
		<div class="card text-center">
			<input onclick='validar()' VALUE='NOVO' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

	

<?php
require 'padrao/rodape.php';
?>


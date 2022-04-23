	<?php
define('titulo', "Painel Novo Funcionário");    
require 'padrao/topo.php';
?>
<p class="h1">NOVO CLIENTE</p>
<hr>
	<form action='./inserir' method='POST' id='frmcliente'>
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
			<select id="estado" name="estado" class="form-control" required>
				<option ></option>
				<option value="AC">Acre</option>
				<option value="AL">Alagoas</option>
				<option value="AP">Amapá</option>
				<option value="AM">Amazonas</option>
				<option value="BA">Bahia</option>
				<option value="CE">Ceará</option>
				<option value="DF">Distrito Federal</option>
				<option value="ES">Espírito Santo</option>
				<option value="GO">Goiás</option>
				<option value="MA">Maranhão</option>
				<option value="MT">Mato Grosso</option>
				<option value="MS">Mato Grosso do Sul</option>
				<option value="MG">Minas Gerais</option>
				<option value="PA">Pará</option>
				<option value="PB">Paraíba</option>
				<option value="PR">Paraná</option>
				<option value="PE">Pernambuco</option>
				<option value="PI">Piauí</option>
				<option value="RJ">Rio de Janeiro</option>
				<option value="RN">Rio Grande do Norte</option>
				<option value="RS">Rio Grande do Sul</option>
				<option value="RO">Rondônia</option>
				<option value="RR">Roraima</option>
				<option value="SC">Santa Catarina</option>
				<option value="SP">São Paulo</option>
				<option value="SE">Sergipe</option>
				<option value="TO">Tocantins</option>
			</select>

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
			<input VALUE='NOVO' type="submit" class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

	

<?php
require 'padrao/rodape.php';
?>


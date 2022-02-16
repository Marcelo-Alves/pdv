<?php
define('titulo', "Painel Novo Funcionário");    
require 'padrao/topo.php';
?>
<p class="h1">NOVO FUNCIONÁRIO</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" required >	
			<br>
			<label for="nome" > Telefone </label>
			<input type='text' name='telefone' id='telefone' required maxlength="14" class="form-control" onkeydown="fMasc( this, mTel );" class="form-control" >	
			<br>
			<label for="nome" > e-mail </label>
			<input type='email' name='email' id='email' class="form-control" required>	
			<br>
			<label for="nome" > CPF </label>
			<input type='text' name='cpf' id='cpf' maxlength="14" onkeydown="fMasc( this, mCPF );" class="form-control" required>	
			<br>
			<label for="matricula" > Matricula </label>
			<input type='text' name='matricula' id='matricula' class="form-control"  >	
			<br>
			<label for="usuario" > Usuário </label>
			<input type='text' name='usuario' id='usuario' class="form-control" required>	
			<br>
			<label for="senha" > Senha </label>
			<input type='password' name='senha' id='senha' class="form-control" required >	
			<br>
			<label for="confirmasenha" >Confirma Senha </label>
			<input type='password' name='confirmasenha' id='confirmasenha' class="form-control" required >	
			<br>
			<label for="nivel" >Nivel </label>
			<select name="id_nivel" id="id_nivel"  class="form-control" required>
				<option>Escolha Nivel</option>
			<?php
				include_once './controller/nivel.php';
				$niveis = Nivel::lista();
				foreach($niveis as $nivel):
					echo "<option value=".$nivel->id_nivel. ">". $nivel->nome ."</option>";
				endforeach;
			?>
			</select>	
			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Ativo</label>
					
						<input type="checkbox" name="ativo" id="ativo">
					</td>
					<td>
						<label for="">Troca Senha</label>
					
						<input type="checkbox" name="trocasenha" id="trocasenha">
					</td>
				</tr>		
			</table>
			
		</div>
		<br>
		
		<div class="card text-center">
			<input type='SUBMIT' VALUE='NOVO' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

	<script type="text/javascript">
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}
			function mTel(tel) {
				tel=tel.replace(/\D/g,"")
				tel=tel.replace(/^(\d)/,"($1")
				tel=tel.replace(/(.{3})(\d)/,"$1)$2")
				if(tel.length == 9) {
					tel=tel.replace(/(.{1})$/,"-$1")
				} else if (tel.length == 10) {
					tel=tel.replace(/(.{2})$/,"-$1")
				} else if (tel.length == 11) {
					tel=tel.replace(/(.{3})$/,"-$1")
				} else if (tel.length == 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				} else if (tel.length > 12) {
					tel=tel.replace(/(.{4})$/,"-$1")
				}
				return tel;
			}
			
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			
		</script>

<?php
require 'padrao/rodape.php';
?>


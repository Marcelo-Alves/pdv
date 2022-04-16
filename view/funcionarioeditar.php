<?php
define('titulo', "Painel Novo Funcionário");    
require 'padrao/topo.php';

$funcionarios = funcionario::editar();
foreach ($funcionarios as $funcionario):
	$id_funcionario = $funcionario->id_funcionario;
	$nome = $funcionario->nome;
	$cpf = $funcionario->cpf;
	$email = $funcionario->email;
	$usuario = $funcionario->usuario;
	$matricula = $funcionario->matricula;
	$id_nivel = $funcionario->id_nivel;
	$telefone = $funcionario->telefone;
	$ativo = ($funcionario->ativo==1)?'checked':'';
	$trocasenha = ($funcionario->trocasenha==1)?'checked':'';	
endforeach;
/*echo "<pre>";
print_r($funcionarios);
echo "</pre>";*/

?>
<p class="h1">ALTERA FUNCIONÁRIO</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			
			<label for="nome" > Nome </label>
			<input type='hidden' name='id_funcionario' id='id_funcionario' value="<?php echo $id_funcionario;?>" >
			<input type='text' name='nome' id='nome' class="form-control"  value="<?php echo $nome ;?>" required >	
			<br>
			<label for="nome" > Telefone </label>
			<input type='text' name='telefone' id='telefone' required maxlength="14"  value="<?php echo $telefone ;?>" class="form-control" onkeydown="javascript: fMasc( this, mTel );" class="form-control" >	
			<br>
			<label for="nome" > e-mail </label>
			<input type='email' name='email' id='email' class="form-control"  value="<?php echo $email ;?>" required>	
			<br>
			<label for="nome" > CPF </label>
			<input type='text' name='cpf' id='cpf' maxlength="14"  value="<?php echo $cpf ;?>" onkeydown="javascript: fMasc( this, mCPF );" class="form-control" required>	
			<br>
			<label for="matricula" > Matricula </label>
			<input type='text' name='matricula' id='matricula' class="form-control"  value="<?php echo $matricula ;?>" >	
			<br>
			<label for="usuario" > Usuário </label>
			<input type='text' name='usuario' id='usuario' class="form-control"  value="<?php echo $usuario ;?>" required>	
			<br>
			<label for="senha" > Senha </label>
			<input type='password' name='senha' id='senha' class="form-control"  >	
			<br>
			<label for="confirmasenha" >Confirma Senha </label>
			<input type='password' name='confirmasenha' id='confirmasenha' class="form-control"  >	
			<br>
			<label for="nivel" >Nivel </label>
			<select name="id_nivel" id="id_nivel"  class="form-control" required>
				<option>Escolha Nivel</option>
			<?php
				include_once './controller/nivel.php';
				$niveis = Nivel::lista();
				foreach($niveis as $nivel):
					echo "<option value=".$nivel->id_nivel .($id_nivel=$nivel->id_nivel?' selected':'').">". $nivel->nome ."</option>";
				endforeach;
			?>
			</select>	
			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Ativo</label>
					
						<input type="checkbox" name="ativo" id="ativo" <?php echo $ativo ;?> >
					</td>
					<td>
						<label for="">Troca Senha</label>
					
						<input type="checkbox" name="trocasenha" id="trocasenha" <?php echo $trocasenha  ;?>>
					</td>
				</tr>			
			</table>
			
		</div>
		<br>
		
		<div class="card text-center">
			<input type="submit" onclick='validar()' VALUE='ALTERAR' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

<?php
require 'padrao/rodape.php';
?>


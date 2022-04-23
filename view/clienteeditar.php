<?php
define('titulo', "Painel Alterar Cliente");    
require 'padrao/topo.php';

$clientes = cliente::editar();
foreach ($clientes as $cliente):
	$id_cliente = $cliente->id_cliente;
	$nome = $cliente->nome;
	$cpf = $cliente->cpf;
	$email = $cliente->email;
	$telefone = $cliente->telefone;
	$rua = $cliente->rua;
	$bairro = $cliente->bairro;
	$cidade = $cliente->cidade;
	$numero = $cliente->numero;
	$estado = $cliente->UF;
	$cep = $cliente->cep;
	$limite = $cliente->limite;
	$telefone = $cliente->telefone;
	$ativo = ($cliente->ativo==1?'checked':'');
endforeach;

$arrayestado = array(
	"AC"=>'Acre',
		 "AL"=>'Alagoas',
		 "AP"=>'Amapá',
		 "AM"=>'Amazonas',
		 "BA"=>'Bahia',
		 "CE"=>'Ceará',
		 "DF"=>'Distrito Federal',
		 "ES"=>'Espírito Santo',
		 "GO"=>'Goiás',
		 "MA"=>'Maranhão',
		 "MT"=>'Mato Grosso',
		 "MS"=>'Mato Grosso do Sul',
		 "MG"=>'Minas Gerais',
		 "PA"=>'Pará',
		 "PB"=>'Paraíba',
		 "PR"=>'Paraná',
		 "PE"=>'Pernambuco',
		 "PI"=>'Piauí',
		 "RJ"=>'Rio de Janeiro',
		 "RN"=>'Rio Grande do Norte',
		 "RS"=>'Rio Grande do Sul',
		 "RO"=>'Rondônia',
		 "RR"=>'Roraima',
		 "SC"=>'Santa Catarina',
		 "SP"=>'São Paulo',
		 "SE"=>'Sergipe',
		 "TO"=>'Tocantins')

/*echo "<pre>";
print_r($clientes);
echo "</pre>";*/

?>
<p class="h1">ALTERA CLIENTE</p>
<hr>
	<form action='../alterar' method='POST'>
	<div class="form-group">
			
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>" required >	
			<input type='hidden' name='id_cliente' id='id_cliente' class="form-control" value="<?php echo $id_cliente ?>" >
			<br>
			<label for="nome" > Telefone </label>
			<input type='text' name='telefone'  value="<?php echo $telefone ?>" id='telefone' required maxlength="14" class="form-control" onkeydown="fMasc(this,mTel);" class="form-control" >	
			<br>
			<label for="nome" > e-mail </label>
			<input type='email' name='email'  value="<?php echo $email ?>" id='email' class="form-control" required>	
			<br>
			<label for="nome" > CPF </label>
			<input type='text' name='cpf' value="<?php echo $cpf ?>" id='cpf' maxlength="14" onkeydown="fMasc(this,mCPF);" class="form-control" required>	
			<br>
			<label for="nome" > CEP </label>
			<input type='text' name='cep' value="<?php echo $cep ?>" id='cep'  maxlength="10" onkeydown="fMasc(this,mCEP);"  class="form-control" required >	
			<br>
			<label for="nome" > Rua </label>
			<input type='text' name='rua' value="<?php echo $rua ?>" id='rua' class="form-control" required >	
			<br>
			<label for="nome" > Número </label>
			<input type='text' name='numero' value="<?php echo $numero ?>" id='numero' class="form-control" required >	
			<br>
			<label for="nome" > Bairro </label>
			<input type='text' name='bairro' value="<?php echo $bairro ?>" id='bairro' class="form-control" required >	
			<br>
			<label for="nome" > Cidade </label>
			<input type='text' name='cidade' id='cidade' value="<?php echo $cidade ?>" class="form-control" required >	
			<br>
			<label for="nome" > Estado </label>
			<select id="estado" name="estado" class="form-control" required>
				<?php 
					foreach($arrayestado as $sigla => $nomeestado):					
						echo "<option value='".$sigla."' ".($estado == $sigla?"selected":"").">".$nomeestado."</option>";											
					endforeach;
				?>
			</select>

			<br>
			<table class="table table-striped table-hover">
				<tr>
					<td>
						<label for="">Ativo</label>
					
						<input type="checkbox" name="ativo"  <?php echo $ativo ?>  id="ativo">
					</td>
					<td>
						<label for="nome" > Limite </label>
						<input type='number' name='limite' value="<?php echo $limite ?>"  id='limite' value='0.00' required >	
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


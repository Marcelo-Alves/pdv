<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
include_once 'controller/categoria.php';
include_once 'controller/fornecedor.php';
$categorias = categoria::lista();
$fornecedores = fornecedor::lista();
?>

<p class="h1">CADASTRO DE PRODUTO</p>
<hr>
	<form action='./inserir' method='POST'>
		<div class="form-group">
			<label for="fornecedor" > Fornecedor </label>
			<select name='id_fornecedor' id='id_fornecedor' class="form-control">
				<?php
					foreach($fornecedores as $fornecedor):
				?>
				<option value='<?php echo ($fornecedor->id_fornecedor);?>' ><?php echo $fornecedor->nome ?></option>
				<?php
					endforeach;
				?>
			<select/>
			<br>
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control">	
			<br>
			<label for="categoria" > Categoria </label>		
			<select name='categoria' class="form-control">
				<option selected>Escolher...</option>
				<?php
					foreach($categorias as $categoria):
				?>
				<option value='<?php echo ($categoria->id_categoria);?>' ><?php echo $categoria->nome ?></option>
				<?php
					endforeach;
				?>
			<select/>
			<br>
			<label for="validades" > Validade </label>		
			<select name='validade' id='validade' class="form-control" onchange="desabilita()">
				<option selected>Escolher...</option>
				<option value='0'>Não</option>
				<option value='1'>Sim</option>
			<select/>
			<br>
			<label for="validade_dias" >Validade em dias </label>			
			<input type='number' disabled name='validade_dias' id='validade_dias' class="form-control" value="0">
			
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Cadastrar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>
<script>
	function desabilita(){
		var validade = document.getElementById("validade").value;
		if(validade == 0){
			document.getElementById("validade_dias").disabled = true;
		}else{
			document.getElementById("validade_dias").disabled = false;
		}
	}
</script>

<?php
require 'padrao/rodape.php';
?>

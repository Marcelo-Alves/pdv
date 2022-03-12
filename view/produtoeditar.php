<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
$produtos = produto::editar();
foreach($produtos as $produto):
	$id_produto = $produto->id_produto;
	$id_fornecedor_prod = $produto->id_fornecedor;
	$id_categoria_prod = $produto->id_categoria;
	$nome = $produto->nome;
	$validade = $produto->validade;
	$validade_dias = $produto->validade_dias;
endforeach;

include_once 'controller/categoria.php';
include_once 'controller/fornecedor.php';
$categorias = categoria::lista();
$fornecedores = fornecedor::lista();

?>

<p class="h1">ALTERAR PRODUTO</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<label for="fornecedor" > Fornecedor </label>
			<select name='id_fornecedor' id='id_fornecedor' class="form-control">
				<?php
					foreach($fornecedores as $fornecedor):
				?>
				<option value='<?php echo $fornecedor->id_fornecedor ?>' <?php echo ($fornecedor->id_fornecedor == $id_fornecedor_prod?"selected":"");?> ><?php echo $fornecedor->nome ?></option>
				<?php
					endforeach;
				?>
			<select/>
			<br>
			<input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto; ?>">
			<label for="nome" > Nome </label>
			<input type='text' name='nome' id='nome' class="form-control" value="<?php echo $nome ?>">	
			<br>
			<label for="categoria" > Categoria </label>		
			<select name='id_categoria' class="form-control">
				<option selected>Escolher...</option>
				<?php
					foreach($categorias as $categoria):
				?>
				<option value='<?php echo $categoria->id_categoria?>' <?php echo ($categoria->id_categoria == $id_categoria_prod?"selected":"");?> >
				<?php echo $categoria->nome ?>
				</option>
				<?php
					endforeach;
				?>
			<select/>
			<br>
			<label for="validade" > Validade </label>		
			<select name='validade' id='validade' class="form-control"  onchange="desabilita()">>
				<option selected>Escolher...</option>
				<option value='0' <?php echo ($validade == 0?"selected":"");?> >Não</option>
				<option value='1' <?php echo ($validade == 1?"selected":"");?> >Sim</option>
			<select/>
			<br>
			<label for="validade_dias" >Validade em dias </label>			
			<input type='number' <?php echo  ($validade_dias == 0?"disabled":""); ?>  name='validade_dias' id='validade_dias' class="form-control" value="<?php echo $validade_dias ?>">
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

	<script>
	function desabilita(){
		var validade = document.getElementById("validade").value;
		
		if(validade == 0){
			document.getElementById("validade_dias").disabled = true;
			document.getElementById("validade_dias").value = 0;
		}else{
			document.getElementById("validade_dias").disabled = false;
			
		}
	}
</script>
<?php
require 'padrao/rodape.php';
?>

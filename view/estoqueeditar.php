<?php
define('titulo', "Painel de Cadastro de Produto");    
require 'padrao/topo.php';
$produtos = estoque::editar();
foreach($produtos as $produto):
	$id_estoque = $produto->id_estoque;
	$id_produto = $produto->id_produto;
	$fornecedor_prod = $produto->fornecedor;
	$categoria_prod = $produto->categoria;
	$lote = $produto->lote;
	$quantidade = $produto->quantidade;
	$nome = $produto->nome;
endforeach;
//print_r($produtos);
include_once 'controller/categoria.php';
include_once 'controller/fornecedor.php';

?>

<p class="h1">ALTERAR ESTOQUE DO PRODUTO</p>
<hr>
	<form action='../alterar' method='POST'>
		<div class="form-group">
			<label for="fornecedor" > Fornecedor </label>
			<label class="form-control" ><?php echo $fornecedor_prod ?></label>
			<br>
			<input type="hidden" name="id_estoque" id="id_estoque" value="<?php echo $id_estoque; ?>">
			<input type="hidden" name="id_produto" id="id_produto" value="<?php echo $id_produto; ?>">
			<label for="nome" > Nome </label>
			<label class="form-control" ><?php echo $nome ?></label>	
			<br>
			<label for="categoria" > Categoria </label>	
			<label class="form-control" ><?php echo $categoria_prod ?></label>	
			<br>
			<label for="categoria" > Lote </label>	
			<input type='text' name='lote' id='lote' class="form-control"  value="<?php echo $lote; ?>">
			<br>
			<label for="categoria" > Quantidade </label>	
			<input type='number' name='quantidade' id='quantidade' class="form-control" value="<?php echo $quantidade; ?>" required>
			
		</div>
		<br>
		<div class="card text-center">
			<input type='SUBMIT' VALUE='Alterar' class="btn btn-lg btn-block btn-outline-primary">
		</div>
	</form>

	
<?php
require 'padrao/rodape.php';
?>

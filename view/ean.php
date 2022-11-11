<?php
define('titulo', "Painel de Lista de Código do Produto");    
require 'padrao/topo.php';

$listas = ean::buscaean();
/*
echo "<pre>";

print_r($listas);
echo "</pre>"; */

$produto_nome =$listas[0]->nome;
$produto_id = $listas[0]->id_produto;

?>

<p class="h1">CÓDIGOS DE PRODUTO</p>
<p class="h3"><?php echo $produto_nome; ?></p>
<hr>
<br>
<form action='./inserir' method="POST">
    <label for="codigo">Código ean do Produto</label>
    <input type="hidden" name="id_produto" value="<?php echo $produto_id ?>" >
    <input type="text" name="ean" id="ean" class="form-control">
    <br>
    <input type='SUBMIT' VALUE='Cadastrar' class="btn btn-lg btn-block btn-outline-primary">
</form>
<br>
<table class="table table-striped table-hover">
	<thead> 
		<tr>
			<th scope="col">Código</th>
			<th scope="col">Deletar</th>
		</tr>
	</thead>
	<tbody>
	
	<?php 
		foreach($listas as $lista):
	?>
        <tr>
            <td scope="row"><?php echo $lista->ean ;?></td>
            <td scope="row">
                <a href="./deletar/<?php echo $lista->id_produto ."/". $lista->id_ean ;?>">
                    <img src="/biblioteca/img/lixeira.jpg" width='30px' >  
                </a>
            </td>
        <tr>
    <?php
		endforeach;
	?>
    </tbody>
	
</table>

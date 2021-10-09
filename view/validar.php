<?php
define('titulo', "Código do Produto já cadastrado");    
require 'padrao/topo.php';
include_once './controller/ean.php';
$listas = ean::buscaean();


$produto_nome =$listas[0]->nome;
$produto_id = $listas[0]->id_produto;

?>

<p class="h1">CÓDIGOS DE PRODUTO</p>
<p class="h3"><?php echo $produto_nome; ?></p>
<hr>
<br>

<table class="table table-striped table-hover">	 
    <tr><th scope="col">Código do Produto já cadastrado</th></tr>
    <tr><th scope="col"><button onclick="window.history.back()" >Voltar</button> </th></tr>
</table>
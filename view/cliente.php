<?php
define('titulo', "Painel de Cliente");    
require 'padrao/topo.php';

$listas = cliente::lista();
/*echo "<pre>";
print_r($listas);
echo "</pre>";*/
?>
<p class="h1">LISTA DE CLIENTE</p>
<hr>
<table class="table table-striped">
		<tr>
			<td scope="col">
				<input type="text" name="cliente" id="cliente" class="form-control" placeholder="Nome Cliente" >
			</td>
			<td>
				<input type="button" value="Buscar" onclick="busca_cliente()" class="form-control" >
			</td>
		</tr>
</table>




<table class="table table-striped table-hover">
	<thead> 
		<tr> 
			<th scope="col">Nome</th>
			<th scope="col">Email</th>
			<th scope="col">CPF</th>	
			<th scope="col">Editar</th>
			<th scope="col">Deletar</th>
		</tr>
	</thead>
	<tbody id="corpo_tabela">
	
	<?php 
		foreach($listas as $lista):
	?>	<tr>
		<td scope="row"><?php echo $lista->nome ;?></td>		
		<td scope="row"><?php echo $lista->email ;?></td>
		<td scope="row"><?php echo $lista->cpf ;?></td>
		<td scope="row">
			<a href="cliente/editar/<?php echo $lista->id_cliente ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/editar.png" width='30px' > 
			</a>
		</td>
		<td scope="row">
			<a href="cliente/deletar/<?php echo $lista->id_cliente ;?>">
				<img src="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/img/lixeira.jpg" width='30px' >  
			</a>
		</td>
		</tr>	
	<?php
		endforeach;
	?>
	</tbody>
	
</table>
<script src="./biblioteca/js/fetchgenerico.js"></script>
<script>
	function busca_cliente(){
		const cliente = document.getElementById('cliente').value;


		const prot = window.location.protocol
		const host = window.location.host;


		
		if(cliente == null  || cliente == undefined || cliente ==''){
			return;
		}
		const tabela = document.getElementById('corpo_tabela');
		const tr = document.createElement('tr');
		const tdnome = document.createElement('td');
		const tdemail = document.createElement('td');
		const tdcpf = document.createElement('td');
		const tdeditar = document.createElement('td');
		const imgeditar = document.createElement('img');
		imgeditar.src = prot+"//"+host+'/biblioteca/img/editar.png';	
		imgeditar.setAttribute('width','30px');
		const imgdeletar = document.createElement('img');
		imgdeletar.src = prot+"//"+host+'/biblioteca/img/lixeira.jpg';	
		imgdeletar.setAttribute('width','30px');
		const tddeletar = document.createElement('td');
		const aeditar = document.createElement('a');		
		const adeletar = document.createElement('a');

		tabela.innerHTML ="";
		const dados = 'tabela=cliente&like='+cliente;

		fetchGenerico('fetch', dados).then(resposta => resposta.json())
		.then(retorno => retorno.map(itens => {
			tdnome.innerHTML= itens.nome;
			tdemail.innerHTML= itens.email;
			tdcpf.innerHTML= itens.cpf;
			aeditar.href="cliente/editar/"+itens.id_cliente;			
			adeletar.href="cliente/deletar/"+itens.id_cliente;
			aeditar.append(imgeditar);
			tdeditar.append(aeditar);
			adeletar.append(imgdeletar);
			tddeletar.append(adeletar);

			tr.append(tdnome);
			tr.append(tdemail);
			tr.append(tdcpf);
			tr.append(tdeditar);
			tr.append(tddeletar);
			tr.append(tdeditar);
			tr.append(tddeletar);
			tabela.appendChild(tr);
		}));

	}
	
</script>
<?php
	require 'padrao/rodape.php';
?>
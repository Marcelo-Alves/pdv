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

function mCEP(cep){
	cep=cep.replace(/\D/g,"")
	cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
	cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
	return cep
}


function mCPF(cpf){
	cpf=cpf.replace(/\D/g,"")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	return cpf
}

function validar() {
   let campo1 = document.getElementById('senha');
   let campo2 = document.getElementById('confirmasenha');
   let formulario= document.getElementById('frmfuncionario');

   if (campo1.value != campo2.value) {
		alert('O campo Confirma Senha tem que ser igual a campo Senha');		
		campo1.style.backgroundColor = "#FF0000";
		campo2.style.backgroundColor = "#FF0000";
		return false;
   }
   else{
	   formulario.submit();
   }    
}

function autocompletar(){
	const nome = document.getElementById('nome_prod').value;
	if(nome != ""){
		const dados = 'nome='+nome;
		const dropdown = document.getElementsByClassName('dropdown');
		const popup = document.getElementById('popup');
		const ul = document.createElement('ul');
		popup.innerHTML ='';
		ul.setAttribute("class","list-group position-fixed");
		fetchGenerico('../produto/buscaproduto',dados)
		.then(response => response.json())
		.then(response =>  response.map(produto => {	
			if(nome.length <= 1 || produto.erro == "vazio" ){
				popup.innerHTML ='';
				return false;
			}				
			const li = document.createElement('li');
			li.setAttribute("class","list-group-item list-group-item-action");
			li.setAttribute("onclick","PegaTexto('"+produto.id_produto+"','"+produto.valor_venda+"','"+produto.nome+"')");
			li.innerHTML = produto.id_produto + ' - ' + produto.nome;
			ul.append(li)
		}));
		
		popup.append(ul);
		
	}
}
function PegaTexto(id_prod,valor,texto){
	document.getElementById('nome_prod').value = texto;
	document.getElementById('id_produto').value = id_prod;
	document.getElementById('valor_venda').value = valor.replace('.',',');
	
	document.getElementById('popup').innerHTML = '';
	document.getElementById('quant').focus;
}



function inseririten(){
	
	const id_produto = document.getElementById('id_produto').value;
	const id_funcionario = document.getElementById('id_funcionario').value;
	const id_cliente = document.getElementById('id_cliente').value;
	const id_venda = document.getElementById('id_venda').value;
	const valor_venda = document.getElementById('valor_venda').value.replace(',','.');			
	const qtde = document.getElementById('quant').value;

	if(id_funcionario == ""){
		alert('Selecione um Vendedor');
		document.getElementById('id_funcionario').style.backgroundColor = "#FF0000";
		return false;
	}


	const dados = new URLSearchParams({'id_produto': id_produto,'id_venda': id_venda,'valor_venda':valor_venda,
		'id_funcionario': id_funcionario,'id_cliente': id_cliente,'qtde': qtde});

	fetchGenerico('../pedido/inserir',dados)
		.then(response => response.json())
		.then(response => carregatabelaitens(response));

	document.getElementById('nome_prod').value = "";
	document.getElementById('quant').value = 1;
}

function carregatabelaitens(linhas){
	let i=0;
	let itenstotal = 0;
	let valorreal = 0.00;
	const tabela = document.getElementById('produto_corpo');
	const spvalor = document.getElementById('valorreal');
	const hdspvalor = document.getElementById('hdvalorreal');
	const spitens = document.getElementById('qtdetotal');
	spvalor.innerHTML='';
	//hdspvalor.value='';
	spitens.innerHTML='';
	tabela.innerHTML='';
	linhas.map(itens => {
		
		if(itens.erro != 'vazio'){
			const tr = document.createElement('tr');
			const tdproduto = document.createElement('td');
			const tdquant = document.createElement('td');
			const tdvunitario = document.createElement('td');
			const tdvenda = document.createElement('td');
			const tdvendedor = document.createElement('td');
			const tdexcluir = document.createElement('td');
			const aexcluir = document.createElement('a');

			tdquant.setAttribute('onclick','alterarquantidade("idquant'+i+'","'+itens.id_venda+'","'+itens.quantidade+'","'+itens.venda+'")');

			tdproduto.innerHTML=itens.produto;
			tdquant.innerHTML=itens.quantidade;
			tdquant.id = 'idquant'+i;
			tdquant.name = 'idquant'+i;
			tdvunitario.innerHTML = itens.unitario.toLocaleString('pt-br', {minimumFractionDigits: 2});
			tdvenda.innerHTML = itens.valor.toLocaleString('pt-br', {minimumFractionDigits: 2});
			tdvendedor.innerHTML=itens.funcionario;
			aexcluir.innerHTML='EXCLUIR';
			aexcluir.setAttribute('class','aexcluir');
			aexcluir.setAttribute('onclick','excluiritem('+itens.id_venda+','+itens.venda+')')
			tdexcluir.appendChild(aexcluir);
			
			tr.appendChild(tdproduto);
			tr.appendChild(tdquant);
			tr.appendChild(tdvunitario);
			tr.appendChild(tdvenda);
			tr.appendChild(tdvendedor);
			tr.appendChild(tdexcluir);
			tabela.append(tr);

			itenstotal = parseInt(itenstotal) + parseInt(itens.quantidade);
			valorreal = parseFloat(valorreal) + parseFloat(itens.valor);
			i=i+1;
		}
	})
	spitens.innerHTML = itenstotal;			
	spvalor.innerHTML = valorreal.toLocaleString('pt-br', {minimumFractionDigits: 2});
	hdspvalor.value = valorreal;
	
}

function alterarquantidade(id,id_venda,quantidade,venda){

	const hiddenid_venda = document.createElement('input');
	const hidden_venda = document.createElement('input');
	const inputquantidade = document.createElement('input');
	inputquantidade.setAttribute('step','0.01');
	const button = document.createElement('button');
	const trocaquantidade = document.getElementById(id);
	trocaquantidade.innerHTML="";

	hiddenid_venda.type='hidden';
	hidden_venda.type='hidden';
	inputquantidade.type='number';
	hiddenid_venda.value = id_venda;
	hidden_venda.value = venda;
	inputquantidade.value = quantidade;
	hiddenid_venda.id = "quantid_venda";
	hidden_venda.id = "quant_venda";
	hidden_venda.name = "quant_venda";
	hiddenid_venda.name = "quantid_venda";
	inputquantidade.id = "quantquantidade"+id_venda;
	inputquantidade.name = "quantquantidade"+id_venda;
	inputquantidade.setAttribute('style','width:70px');
	button.innerHTML='Alterar';
	button.setAttribute("onclick","gravaralterar("+id_venda+",quantquantidade"+id_venda+","+venda+")")

	trocaquantidade.append(hiddenid_venda);
	trocaquantidade.append(hidden_venda);
	trocaquantidade.append(inputquantidade);
	trocaquantidade.append(button);
	document.getElementById(id).setAttribute("onclick","");
	

}

function gravaralterar(id_venda,quantidade,venda){
	
	const dados = new URLSearchParams({'id_venda': id_venda,'qtde': quantidade.value,'venda': venda});
	
	fetchGenerico('../pedido/alteraprodutopedido',dados)
		.then(response => response.json())
		.then(response => carregatabelaitens(response));
}

function excluiritem(id_venda,venda){
	const dados = new URLSearchParams({'id_venda': id_venda,'venda': venda});
	let excluir = confirm('Deseja excluir?');
	
	fetchGenerico('../pedido/excluiritem',dados)
		.then(response => response.json())
		.then(response => carregatabelaitens(response));
}


function mascaraMoeda(){

	let elemento = document.getElementById('dintotal');
	let valor = elemento.value;

	valor = valor + '';
	valor = parseInt(valor.replace(/[\D]+/g, ''));
	valor = valor + '';
	valor = valor.replace(/([0-9]{2})$/g, ",$1");

	if (valor.length > 6) {
		 valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
	}

	elemento.value = valor;
	if(valor == 'NaN') elemento.value = '';
}

function calcularvalor(valor){
	let preco = document.getElementById('hdvalorreal').value;
	const labelvalor = document.getElementById('valortroco');

	preco = preco.replace('.','');
	preco = preco.replace(',','.');
	valor = valor.value.replace(',','.');
	preco = parseFloat(preco);
	valor = parseFloat(valor);
	let resultado = parseFloat(valor) - parseFloat(preco);
	resultado = resultado.toLocaleString('pt-br', {minimumFractionDigits: 2});
	labelvalor.innerHTML = resultado;

}


function verificaPedido(){
	//document.querySelectorAll('button').style.color='black';
	let quantbutton = document.querySelectorAll('BUTTON').length;
	for(let i = 1; i <= quantbutton ; i++ ){		
			document.getElementById(i).style.color='green';
	}
//*/
	fetchGenericoTudo('../pedido/pedidoativo')
		.then(response => response.json())
		.then(response => response.map(itens => {
			document.getElementById(itens.venda).style.color='red';
		}));
}
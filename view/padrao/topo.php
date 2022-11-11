<?php
if(session_start() == false):
	session_start();
endif;
$telas = array('painel','caixa','venda');
$URI = $_SERVER['REQUEST_URI'];
$URI = explode('/',$URI);
$URI = $URI[1];

if(isset($_SESSION['nome'])):
	if($_SESSION[$URI]!=1):
		for($i=0;$i<count($telas);$i++):		
			if($_SESSION[$telas[$i]]==1):				
				header("Location: /".$telas[$i]);	
        $i = count($telas);
			endif;
		endfor;
	endif;
else:
  header("Location: /");	
endif;

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
  <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Controle de estoque">
		<meta name="author" content="Marcelo Alves">   
		<title><?php echo titulo; ?></title>
    <link href="/biblioteca/css/bootstrap.css" rel="stylesheet">   
	<link href="/biblioteca/css/dashboard.css" rel="stylesheet">     

    <style>
      .ck-editor__editable_inline {
          min-height: 400px;
      }
  </style>
  <script src='/biblioteca/js/fetchgenerico.js'></script>
  <script>
    function esconde(campo){
      var div = document.getElementById(campo);
      div.style.display = (div.style.display === 'block'?'none':'block');
    }
  </script>

  </head>

  <body cz-shortcut-listen="true">
     <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color: #000;color: #fff;">
        <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
		<span class="navbar-brand"> Seja bem vindo, <?php echo $_SESSION['nome'];?></span>
        <a class="navbar-brand" href="/painel">Principal</a>
  
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          
        </div>
      </nav>

    <div class="container">
      <div class="row">

        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
        
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('liproduto')" >Produtos</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="liproduto">
                <li class="nav-item"><a class="nav-link" href="/produto">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/produto/form">Novo</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('liestoque')" >Estoque</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="liestoque">
                <li class="nav-item"><a class="nav-link" href="/estoque">Lista</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('licategoria')" >Categoria</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="licategoria">
                <li class="nav-item"><a class="nav-link" href="/categoria">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/categoria/form">Novo</a></li>
              </ul>
            </li>
			      <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('livendas')" >Venda</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="livendas">
                <li class="nav-item"><a class="nav-link" href="/relatorio">Relatórios</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('livalor')" >Valor</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="livalor">
                <li class="nav-item"><a class="nav-link" href="/valor">Lista</a></li>
              </ul>
            </li>
			
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('licliente')" >Cliente</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="licliente">
                <li class="nav-item"><a class="nav-link" href="/cliente">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/cliente/form">Novo</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('lifuncionario')" >Funcionário</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="lifuncionario">
                <li class="nav-item"><a class="nav-link" href="/funcionario">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/funcionario/form">Novo</a></li>
              </ul>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('lifornecedor')" >Fornecedor</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="lifornecedor">
                <li class="nav-item"><a class="nav-link" href="/fornecedor">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/fornecedor/form">Novo</a></li>
              </ul>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" onclick="esconde('linivel')" >Nível</a>
              <ul class="nav nav-pills flex-column ms-3" style="display: none;" id="linivel">
                <li class="nav-item"><a class="nav-link" href="/nivel">Lista</a></li>
                <li class="nav-item"><a class="nav-link" href="/nivel/form">Novo</a></li>
              </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/sair">Sair</a>
              </li>  
          </ul>          
        </nav>
		
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
		

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
  <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Controle de estoque">
		<meta name="author" content="Marcelo Alves">   
		<title><?php echo titulo; ?></title>
    <link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/bootstrap.css" rel="stylesheet">   
	<link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/dashboard.css" rel="stylesheet">     

    <style>
      .ck-editor__editable_inline {
          min-height: 400px;
      }
  </style>

  </head>

  <body cz-shortcut-listen="true">
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse" style="background-color: #000;">
        <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>">Principal</a>
  
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          
        </div>
      </nav>




    <div class="container">
      <div class="row">

      
          
            
      
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
        <button data-bs-toggle="collapse" data-bs-target="#produtodiv">
              Produto
          </button>
          <div class="collapse" id="produtodiv">           
              <a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/produto">lista</a>
              <a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/produto/form">Novo</a>
             
          </div>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/produto">Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/estoque">Estoque</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/categoria">Categoria</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="">Sair</a>
              </li>  
          </ul>          
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">




















<!--

<html lang="pt-BR">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Controle de estoque">
		<meta name="author" content="Marcelo Alves">   
		<title><?php echo titulo; ?></title>	

		<!-- Principal CSS do Bootstrap -- >
		<link href="<?php echo 'http://'. $_SERVER['HTTP_HOST'];?>/biblioteca/css/bootstrap.css" rel="stylesheet">        
    </head>
    <body>
    <div class="container">
	-->
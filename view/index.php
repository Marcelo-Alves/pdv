<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Controle de estoque">
    <meta name="author" content="Marcelo Alves">   

    <title>Tela de Login de Controle de Estoque</title>

    <!-- Principal CSS do Bootstrap -->
    <link href="./biblioteca/css/bootstrap.css" rel="stylesheet">

  </head>

  <body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="login" class="text-info">Login:</label><br>
                                <input type="text" name="login" id="login" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="text-info">Senha:</label><br>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="Logar" class="btn btn-info btn-md" value="Logar">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


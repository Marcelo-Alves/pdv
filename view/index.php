<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Controle de Estoque">
    <meta name="author" content="Marcelo Alves">   

    <title>Tela de Login de Controle de Estoque</title>

    <!-- Principal CSS do Bootstrap -->
    <link href="./biblioteca/css/bootstrap.css" rel="stylesheet">
	<script src='./biblioteca/js/fetchgenerico.js'></script>
	<script>
		function login(){
						
			const usuario = document.getElementById('usuario').value;
			const senha = document.getElementById('senha').value;
			const dados = 'usuario='+usuario+'&senha='+senha;
		
			fetchGenerico('login',dados)
			.then(response => response.json())
			.then(retorno => {switch(retorno.nivel){
					case 'estoque':
						window.location.href = '/estoque';
						break;
					case 'venda':
						window.location.href = '/venda';
						break;
					case 'caixa':
						window.location.href = '/caixa';
						break;
					case 'erro':
						console.log('erro');
						break;
				}
			});
		}
	</script>

  </head>

  <body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
			<div id="erro" name="erro"></div>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                       <!-- <form id="login-form" name="login-form" class="form">-->
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="login" class="text-info">Usuário:</label><br>
                                <input type="text" name="usuario" id="usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="senha" class="text-info">Senha:</label><br>
                                <input type="password" name="senha" id="senha" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <input onclick='login()' type="submit" name="Logar" class="btn btn-info btn-md" value="Logar">
                            </div>
                            
                        <!--</form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


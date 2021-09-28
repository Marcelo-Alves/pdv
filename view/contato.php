<?php    
    define('titulo', "Contato");
    require 'padrao/topo.php';

    $cont = new contato() ;
    echo "<pre>";
    foreach ($cont->Contatos() as $contatos){
        echo $contatos->nome. 
                " email " .$contatos->email. 
                " email " .$contatos->mensagem."<br>";
    }
    




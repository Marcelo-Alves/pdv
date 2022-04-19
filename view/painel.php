<?php
define('titulo', "Painel de Controle de Estoque");
    
require 'padrao/topo.php';

echo " O Painel esta " . painel::lista();

require 'padrao/rodape.php';
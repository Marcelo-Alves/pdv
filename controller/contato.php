<?php
include_once 'model/busca.php';
class contato {
    public function Contatos(){
        
        return busca::Retorno();
    }
}

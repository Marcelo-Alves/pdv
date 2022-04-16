<?php
session_start();
class sair {
    public static function lista(){
        session_destroy();
		header("Location: /");
		
    }
    
}
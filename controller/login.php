<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1); //*/

include_once './model/busca.php';

class Login{
	public static function lista(){
		
		$POST = json_encode($_POST, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$POST = json_decode($POST);
		
		$usuario =  html_entity_decode($POST->usuario);
		$senha = html_entity_decode($POST->senha);	



		if(empty($usuario) || empty($senha) ){
			echo '{"nivel":"vazio"}';
			return;
		}
		
		$tabela = 'funcionario f inner join nivel n on f.id_nivel = n.id_nivel';
		$campos = 'f.nome as nome, f.email, f.usuario, n.caixa, n.venda, n.estoque, n.produto, n.usuario, 
					n.fornecedor,n.funcionario, n.empresa, n.sangria, n.excluir_item, n.relatorio, n.desconto ,n.valor_desconto';
		$condicao = ' and f.usuario="'.$usuario.'" and f.senha="'.$senha.'" and ativo =1';
		$funcionario = busca::buscaWhere($campos,$tabela,$condicao);
		
		if($funcionario){
			session_start();
			
			foreach($funcionario[0] as $cha => $fun){
				$_SESSION[$cha] = $fun;				
			}
			
			foreach($funcionario  as $cha => $fun){
					if( $fun->estoque ==1){
						echo '{"nivel":"painel"}';
					}elseif( $fun->venda ==1){
						echo '{"nivel":"pedido"}';
					}elseif( $fun->caixa ==1){
						echo '{"nivel":"caixa"}';
					}	
			}
		}else{
			echo '{"nivel":"erro"}';
		}
	}
}	

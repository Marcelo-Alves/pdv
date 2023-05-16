<?php
    include_once './model/busca.php';
    include_once './model/inserir.php';
    include_once './model/alterar.php';

    class valor{
        public static function lista(){
            $produto = busca::buscaWhere('*',
            'produto p inner join valor_venda v on p.id_produto=v.id_produto',
            ' and valor_atual=1',"order by p.id_produto");
            return $produto;
        }
 
        public static function buscavalor(){
            $nome = $_POST['nome'];
            $campos = '*';
            $tabela = 'produto p inner join valor_venda v on p.id_produto=v.id_produto';
            $where = ' and p.nome like "%'.$nome.'%" and valor_atual=1';
            $order = "order by p.id_produto";
            $produto = busca::buscaWhere($campos, $tabela , $where,$order);
            
            if(count($produto) > 0){
                echo json_encode($produto);
            }
            else{
                echo json_encode(array(0 => array("erro"=>"vazio")));
            }
        }

        public static function inserir(){

   /*         echo "<pre>";
            print_r($_POST);
            echo "</pre>";
/*/


            try{

                $campos_inserir = array(			
                    'id_produto'  => "'".$_POST['id_produto']."'",
                    'valor_compra'=> "'".$_POST['compra']."'",
                    'valor_venda' => "'".$_POST['venda']."'",
                    'valor_atual' => "'1'",
                    'data_atualizar' => "'". date('Y-m-d H:i:s')."'",
                );	
                
                $model_campos="";
                $model_valores="";
                
                foreach($campos_inserir as $campos => $nome){
                    $model_campos = $model_campos . $campos . ",";
                    $model_valores  = $model_valores . "" . $nome . ",";
                }
                
                $model_campos = substr($model_campos,0,-1);
                $model_valores  = substr($model_valores,0,-1);
                $tabela = 'valor_venda';
                
                $campos = 'valor_atual=0';
                $where = "id_produto = ".$_POST['id_produto'];
                alterar::alterarBanco($campos,$tabela,$where);

                inserir::inserirBanco($tabela,$model_campos,$model_valores) ;

                echo json_encode(array(0 => array("erro"=>"vazio")));
            }
            catch (Exception $e) {
                echo json_encode(array(0 => array("erro"=>"alterar")));
            }

        }
    }

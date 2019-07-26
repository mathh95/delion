<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../controler/controlCardapio.php";
	protegePagina();
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
        if( $_SERVER['REQUEST_METHOD'] == "POST" ){

            $cod_produto = $_POST['cod_produto'];
            $op = $_POST['op'];
            if($op == 'inc'){
                if( isset($_SESSION['carrinhoWpp'][$cod_produto]) ){
                    $_SESSION['carrinhoWpp'][$cod_produto] = $_SESSION['carrinhoWpp'][$cod_produto] + 1;
                }
                else{
                    $_SESSION['carrinhoWpp'][$cod_produto] = 1;
                }
            }
            elseif($op == 'dec'){
    
                if( isset($_SESSION['carrinhoWpp'][$cod_produto]) ){

                    if ($_SESSION['carrinhoWpp'][$cod_produto] > 1){
                        $_SESSION['carrinhoWpp'][$cod_produto] = $_SESSION['carrinhoWpp'][$cod_produto] - 1;
                    }
                    else{
                        unset($_SESSION['carrinhoWpp'][$cod_produto]);
                    }
                }
            }

            echo json_encode([]);
        }
        elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

            $controller = new controlerCardapio($_SG['link']);
            $array = $_SESSION['carrinhoWpp'];
            $keys_array = [];
            while($item = current($array)){
                array_push($keys_array, key($array));
                next($array);
            }
            $batata = [];
            if(!empty($keys_array))
                $batata = $controller->buscarVariosId($keys_array);
            
            $return_array = [];
            foreach($batata as $item){
                $return_array[$item['cod_cardapio']] = [];
                $return_array[$item['cod_cardapio']]['nome'] = $item['nome'];
                $return_array[$item['cod_cardapio']]['valor'] = $item['preco'];
                $return_array[$item['cod_cardapio']]['qtd'] = $array[$item['cod_cardapio']];
            }
            echo json_encode($return_array);

        }
        elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    
            parse_str(file_get_contents("php://input"), $args);
            if( isset($_SESSION['carrinhoWpp'][$args['cod_produto']]) ){
                unset($_SESSION['carrinhoWpp'][$args['cod_produto']]);
            }

        }

    }
    else{
		expulsaVisitante();
	}
?>
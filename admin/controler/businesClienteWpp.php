<?php 
    include_once "seguranca.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
    include_once MODELPATH. "/cliente-wpp.php";
    include_once CONTROLLERPATH."/controlClienteWpp.php";
    include_once "../controler/controlCardapio.php";
    include_once "../controler/controlCarrinhoWpp.php";
    include_once "../lib/alert.php";
    protegePagina();
    
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
        }
        $nome= addslashes(htmlspecialchars($_POST['nome']));
        $telefone=addslashes(htmlspecialchars($_POST['telefone']));
        $rua=addslashes(htmlspecialchars($_POST['rua']));
        $numero=addslashes(htmlspecialchars($_POST['numero']));
        $bairro=addslashes(htmlspecialchars($_POST['bairro']));
        $complemento=addslashes(htmlspecialchars($_POST['complemento']));
        $status=1;
        $clienteWpp = new ClienteWpp;
        $clienteWpp->construct($nome, $telefone, $rua, $numero, $bairro, $complemento);

        
        // echo ("<pre>");
        // print_r($clienteWpp);
        // echo("</pre>");
        $control = new controlClienteWpp($_SG['link']);
        $result=$control->insert($clienteWpp);
        if($result == -1){
            alertJSVoltarPagina('Erro!','Erro ao cadastrar pedido!',2);
			
		}// }else{
		// 	msgRedireciona('Pedido realizado!','Pedido cadastrado com sucesso!', 1,'../view/admin/pedidoWppLista.php');
		// }

        $controller = new controlerCardapio($_SG['link']);
        $array = $_SESSION['carrinhoWpp'];
        $keys_array = [];
        while($item = current($array)){
            array_push($keys_array, key($array));
            next($array);
        }
        $itens = [];
        if(!empty($keys_array))
            $itens = $controller->buscarVariosId($keys_array);
        
        $return_array = [];
        $valor = 0;
        foreach($itens as $item){
            $valor += $item['preco'] * $array[$item['cod_cardapio']];
            $return_array[$item['cod_cardapio']] = [];
            $return_array[$item['cod_cardapio']]['valor'] = $item['preco'];
            $return_array[$item['cod_cardapio']]['qtd'] = $array[$item['cod_cardapio']];
        }
        //Todo 
        //Inserçao de dados na controlCarrinhoWpp
        
        $pedido = new PedidoWpp;
        $pedido->construct($result, $valor, $status);

        $control = new controlerCarrinhoWpp($_SG['link']);
        $control->setPedidoWpp($pedido);

		
	}else{
		expulsaVisitante();
    }
?>
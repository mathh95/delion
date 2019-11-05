<?php
session_start();
// ini_set('display_errors', true);

// date_default_timezone_set('America/Sao_Paulo');



// include_once "../../admin/controler/conexao.php";

// require_once "../controler/controlCarrinho.php";

// require_once "../controler/controlCardapio.php";

// include_once "../lib/alert.php";

$preco = $_GET['preco'];
$acao = $_GET['acao'];
// $valorcupom = $_GET['valorcupom'];
// echo "<pre>";
// print_r($valorcupom);
// echo "</pre>";
if (isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery'] = $_GET['delivery'];
}
//função pra aumentar a quantidade de um item no carrinho
if($acao == "+"){
    
    $qtdAtual = $_GET['qtdAtual'];
    $linha = $_GET['linha'];
    $_SESSION['qtd'][$linha] = $qtdAtual+1;    
    $_SESSION['totalCarrinho'] += $preco;
    $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
    
    $_SESSION['totalCorrigido'] += $preco;

    //verifica se valor do pedido é suficiente para delivery
    if(isset($_SESSION['valor_entrega_minimo'])){
        if($_SESSION['totalCarrinho'] >= $_SESSION['valor_entrega_minimo']){
            $_SESSION['valor_entrega_valido'] = 1;
        }else{
            $_SESSION['valor_entrega_valido'] = 0;
        }
    }

    //verifica se entrega é grátis
    if($_SESSION['totalCarrinho'] >= $_SESSION['minimo_taxa_gratis']){
        $_SESSION['delivery_free'] = 1;

        //dec total se valor delivery anteriormente settado
        if($_SESSION['delivery_price'] > 0){
            $_SESSION['totalCorrigido'] -= (float) $_SESSION['delivery_price_calculado'];
        }

        $_SESSION['delivery_price'] = (float) 0;
    }

    echo json_encode(
        array(
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'],
            "totalCorrigido" => $_SESSION['totalCorrigido'],
            "taxaEntrega" => $_SESSION['delivery_price']
            )
        );
        
    return;
    
//função para diminuir uma quantidade de um item no carrinho
}elseif($acao == "-"){

    //remove item quando qtd 0
    if(isset($_GET['id']) && !empty($_GET['id'])){

        $id = $_GET['id'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                sort($_SESSION['carrinho']);
                sort($_SESSION['qtd']);

                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valorcupom'] = 0.00;
                    
                    echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }
        $_SESSION['totalCarrinho'] -= (float)$preco;
        $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
        
        $_SESSION['totalCorrigido'] -= (float)$preco;


        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['totalCarrinho'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['totalCarrinho'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente settado
            if($_SESSION['delivery_price'] == 0){

                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['totalCorrigido'] += (float) $_SESSION['delivery_price'];
            }
        }

        echo json_encode(
            array(
                "valorcupom" => $_SESSION['valorcupom'],
                "totalCarrinho" => $_SESSION['totalCarrinho'],
                "totalComDesconto" => $_SESSION['totalComDesconto'],
                "totalCorrigido" => $_SESSION['totalCorrigido'],
                "taxaEntrega" => $_SESSION['delivery_price']
                )
            );
            
        return;


    //remove unidade do item sem zerar 
    }else{

        $qtdAtual = $_GET['qtdAtual'];
        $linha = $_GET['linha'];
        $_SESSION['qtd'][$linha] = $qtdAtual-1;
        $_SESSION['totalCarrinho'] -= $preco;
        $_SESSION['totalComDesconto'] = ((float)$_SESSION['totalCarrinho'] - (float)$_SESSION['valorcupom']);
        
        $_SESSION['totalCorrigido'] -= (float) $preco;

        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['totalCarrinho'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['totalCarrinho'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente estava settado
            if($_SESSION['delivery_price'] == 0){
                
                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['totalCorrigido'] += (float) $_SESSION['delivery_price'];
            }
        }

        echo json_encode(
            array(
            "valorcupom" => $_SESSION['valorcupom'],
            "totalCarrinho" => $_SESSION['totalCarrinho'],
            "totalComDesconto" => $_SESSION['totalComDesconto'],
            "totalCorrigido" => $_SESSION['totalCorrigido'],
            "taxaEntrega" => $_SESSION['delivery_price']
            )
        );
            
        return;
    }
//função para remover todas as unidades de um item do carrinho
}
elseif($acao == "rem"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        $qtd = $_GET['qtdAtual'];
        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                sort($_SESSION['carrinho']);
                sort($_SESSION['qtd']);

                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valorcupom'] = 0.00;
                    echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }

        $aux = $qtd * $preco;
        $_SESSION['totalCarrinho']-= $aux;
        $_SESSION['totalComDesconto'] = ($_SESSION['totalCarrinho'] - $_SESSION['valorcupom']);



        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['totalCarrinho'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['totalCarrinho'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente estava settado
            if($_SESSION['delivery_price'] == 0){
                
                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['totalCorrigido'] += (float) $_SESSION['delivery_price'];
            }
        }

        echo json_encode(
            array(
                "totalCarrinho" => $_SESSION['totalCarrinho'],
                "totalComDesconto" => $_SESSION['totalComDesconto'],
                "totalCorrigido" => $_SESSION['totalCorrigido'],
                "taxaEntrega" => $_SESSION['delivery_price']
            )
        );
        
        return;        
    }
}
// função para esvaziar o carrinho
elseif($acao == "esv"){
    $_SESSION['totalCarrinho'] = 0;
    $_SESSION['totalComDesconto'] = 0;
    $_SESSION['valorcupom'] = 0;
    $_SESSION['totalCorrigido'] = 0;
    unset($_SESSION['carrinho']);
    unset($_SESSION['qtd']);
}

//função para remover o cupom
elseif($acao == "removeCupom"){
    $_SESSION['valorcupom'] = 0;
}

?>
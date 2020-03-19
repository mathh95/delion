<?php
session_start();

$acao = $_GET['acao'];

if(isset($_GET['preco'])) $preco = $_GET['preco'];

//função pra aumentar a quantidade de um item no carrinho
if($acao == "+"){
    
    $qtdAtual = $_GET['qtdAtual'];
    $linha = $_GET['linha'];
    $_SESSION['qtd'][$linha] = $qtdAtual+1;    
    $_SESSION['valor_subtotal'] += $preco;
    $_SESSION['total_com_desconto'] = ((float)$_SESSION['valor_subtotal'] - (float)$_SESSION['valor_cupom']);
    
    $_SESSION['valor_total'] += $preco;

    //verifica se valor do pedido é suficiente para delivery
    if(isset($_SESSION['valor_entrega_minimo'])){
        if($_SESSION['valor_subtotal'] >= $_SESSION['valor_entrega_minimo']){
            $_SESSION['valor_entrega_valido'] = 1;
        }else{
            $_SESSION['valor_entrega_valido'] = 0;
        }
    }

    //verifica se entrega é grátis
    if($_SESSION['valor_subtotal'] >= $_SESSION['minimo_taxa_gratis']){
        $_SESSION['delivery_free'] = 1;

        //dec total se valor delivery anteriormente settado
        if($_SESSION['delivery_price'] > 0){
            $_SESSION['valor_total'] -= (float) $_SESSION['delivery_price_calculado'];
        }

        $_SESSION['delivery_price'] = (float) 0;
    }

    echo json_encode(
        array(
            "valorcupom" => $_SESSION['valor_cupom'],
            "totalCarrinho" => $_SESSION['valor_subtotal'],
            "totalComDesconto" => $_SESSION['total_com_desconto'],
            "totalCorrigido" => $_SESSION['valor_total'],
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
                // sort($_SESSION['carrinho']);
                // ksort($_SESSION['qtd']);
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
                $_SESSION['qtd'] = array_values($_SESSION['qtd']);
                $_SESSION['observacao'] = array_values($_SESSION['observacao']);

                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valor_cupom'] = 0.00;
                    
                    //echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }
        $_SESSION['valor_subtotal'] -= (float)$preco;
        $_SESSION['total_com_desconto'] = ((float)$_SESSION['valor_subtotal'] - (float)$_SESSION['valor_cupom']);
        
        $_SESSION['valor_total'] -= (float)$preco;


        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['valor_subtotal'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['valor_subtotal'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente settado
            if($_SESSION['delivery_price'] == 0){

                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['valor_total'] += (float) $_SESSION['delivery_price'];
            }
        }

        echo json_encode(
            array(
                "valorcupom" => $_SESSION['valor_cupom'],
                "totalCarrinho" => $_SESSION['valor_subtotal'],
                "totalComDesconto" => $_SESSION['total_com_desconto'],
                "totalCorrigido" => $_SESSION['valor_total'],
                "taxaEntrega" => $_SESSION['delivery_price']
                )
            );
            
        return;


    //remove unidade do item sem zerar 
    }else{

        $qtdAtual = $_GET['qtdAtual'];
        $linha = $_GET['linha'];
        $_SESSION['qtd'][$linha] = $qtdAtual-1;
        $_SESSION['valor_subtotal'] -= $preco;
        $_SESSION['total_com_desconto'] = ((float)$_SESSION['valor_subtotal'] - (float)$_SESSION['valor_cupom']);
        
        $_SESSION['valor_total'] -= (float) $preco;

        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['valor_subtotal'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['valor_subtotal'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente estava settado
            if($_SESSION['delivery_price'] == 0){
                
                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['valor_total'] += (float) $_SESSION['delivery_price'];
            }
        }

        //Reordena o index dos itens
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
        $_SESSION['qtd'] = array_values($_SESSION['qtd']);
        $_SESSION['observacao'] = array_values($_SESSION['observacao']);

        echo json_encode(
            array(
            "valorcupom" => $_SESSION['valor_cupom'],
            "totalCarrinho" => $_SESSION['valor_subtotal'],
            "totalComDesconto" => $_SESSION['total_com_desconto'],
            "totalCorrigido" => $_SESSION['valor_total'],
            "taxaEntrega" => $_SESSION['delivery_price']
            )
        );
            
        return;
    }

    //função para remover todas as unidades de um item do carrinho
}elseif($acao == "rem"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        
        $id = $_GET['id'];
        $qtd = $_GET['qtdAtual'];

        foreach($_SESSION['carrinho'] as $key => $value){
            if($id == $value){
                unset($_SESSION['carrinho'][$key]);
                unset($_SESSION['qtd'][$key]);
                unset($_SESSION['observacao'][$key]);
                // sort($_SESSION['carrinho']);
                // sort($_SESSION['qtd']);
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
                $_SESSION['qtd'] = array_values($_SESSION['qtd']);
                $_SESSION['observacao'] = array_values($_SESSION['observacao']);


                if(count($_SESSION['carrinho']) < 1){
                    $_SESSION['valor_cupom'] = 0.00;
                    // echo "<script>swal('Carrinho vazio!!').then((value) => {window.location='/home/cardapio.php'});</script> ";
                }
            }
        }

        $aux = $qtd * $preco;
        $_SESSION['valor_subtotal']-= $aux;
        $_SESSION['total_com_desconto'] = ($_SESSION['valor_subtotal'] - $_SESSION['valor_cupom']);



        //verifica se valor do pedido é suficiente para delivery
        if(isset($_SESSION['valor_entrega_minimo'])){
            if($_SESSION['valor_subtotal'] >= $_SESSION['valor_entrega_minimo']){
                $_SESSION['valor_entrega_valido'] = 1;
            }else{
                $_SESSION['valor_entrega_valido'] = 0;
            }
        }

        //verifica se entrega é grátis
        if($_SESSION['valor_subtotal'] < $_SESSION['minimo_taxa_gratis']){
            
            $_SESSION['delivery_free'] = 0;
            
            //dec total se valor delivery anteriormente estava settado
            if($_SESSION['delivery_price'] == 0){
                
                //já calculado ao carregar o carrinho, delivery_price volátil
                $_SESSION['delivery_price'] = $_SESSION['delivery_price_calculado'];

                $_SESSION['valor_total'] += (float) $_SESSION['delivery_price'];
            }
        }

        echo json_encode(
            array(
                "totalCarrinho" => $_SESSION['valor_subtotal'],
                "totalComDesconto" => $_SESSION['total_com_desconto'],
                "totalCorrigido" => $_SESSION['valor_total'],
                "taxaEntrega" => $_SESSION['delivery_price']
            )
        );
        
        return;        
    }

// função para esvaziar o carrinho
}elseif($acao == "esv"){
    $_SESSION['valor_subtotal'] = 0;
    $_SESSION['total_com_desconto'] = 0;
    $_SESSION['valor_cupom'] = 0;
    $_SESSION['valor_total'] = 0;
    unset($_SESSION['carrinho']);
    unset($_SESSION['qtd']);
    unset($_SESSION['observacao']);
    
    if(isset($_SESSION['adicionais_selecionados'])){
        unset($_SESSION['adicionais_selecionados']);
    }


//função para remover o cupom
}elseif($acao == "removeCupom"){
    $_SESSION['valor_cupom'] = 0;


//função para remover item de Resgate
}elseif($acao == "rem_resgate"){

    if(isset($_GET['id']) && !empty($_GET['id'])){
        
        $id = $_GET['id'];

        $itens = $_SESSION['carrinho_resgate'];
        foreach($itens as $cod_item => $qtd_item){

            if($cod_item == $id){
                unset($_SESSION['carrinho_resgate'][$cod_item]);
            }
        }

        return;        
    }
}

?>
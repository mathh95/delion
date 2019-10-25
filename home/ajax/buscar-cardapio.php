<?php
session_start();

ini_set('display_errors', true);
date_default_timezone_set('America/Sao_Paulo');
include_once "../../admin/controler/conexao.php";
include_once "../controler/controlCardapio.php";
include_once "../controler/controlCategoria.php";
include_once "../controler/controlAdicional.php";
include_once MODELPATH."/adicional.php";
include_once "../lib/alert.php";

$controleAdicional = new controlerAdicional(conecta());


$busca = addslashes(htmlspecialchars($_GET['search']));

$controle_categoria = new controlerCategoria(conecta());
$controle_cardapio = new controlerCardapio(conecta());

// ============================================
// Monta outra consulta MySQL para a busca

if (isset($_GET['delivery']) && !empty($_GET['delivery'])) {

    $delivery = $_GET['delivery'];

} else {

    $delivery = false;
}

if ($delivery == true ){
    $quantidade = $controle_cardapio->selectDelivery($busca,1);
}else{
    $quantidade = $controle_cardapio->select($busca,1);
    //cria outra busca aqui
}


$categorias = $controle_categoria->selectAllByPos();
//itens por categoria ordenados
foreach ($categorias as $key_cat => $categoria) {

    echo 
        "<div style='width:100%;' colspan='7' style='background-color:red; color:white; font-size:20px;' >
                <img src='../../".$categoria->getIcone()."' style='max-height: 25px; border-radius:5px;' alt=''/>
                ".$categoria->getNome()."
        </div>";
    

    $itens = $controle_cardapio->selectByCategoriaByPosServindo(
        $categoria->getCod_categoria()
    );	
    foreach ($itens as $key_item => $item){

        echo
            "<div class='produto'>
                <div class='imagem'>
                    <div class='titulo'>".$item->getNome()."</div>
                    <img title='".$item->getNome()."' alt='".$item->getNome()."' src='../admin/".$item->getFoto()."'>
                </div>
                <div class='descricao'>
                    <div class='titulo'>DESCRIÇÃO</div>
                    <div class='texto'>".html_entity_decode($item->getDescricao())."</div>
                    <div class='texto'>". $item->getDsDelivery()." para delivery</div>
                    
                    <div class='preco'><strong>R$ ".$item->getPreco()."</strong></div>
                    
                    <button  id='addCarrinho' data-url='ajax/add-carrinho.php' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar ao Pedido</button><br>
                    <button id='addCombo' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar ao Combo</button>
                </div>
            </div>";
    }
}
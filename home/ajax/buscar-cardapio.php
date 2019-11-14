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
        "<div class='categoria' id='categoria".$categoria->getCod_categoria()."' >
                <img src='../admin/".$categoria->getIcone()."'/>
                ".$categoria->getNome()."
        </div>";
    

    $itens = $controle_cardapio->selectByCategoriaByPosServindo(
        $categoria->getCod_categoria()
    );

    $hora_atual = date('H:i:s', time() - 3600);// horário de verão extinto
    $hoje = (date('w')+1); // 1 == domingo, 7 == sábado
    
    $categoria_com_itens = 0;
    foreach ($itens as $key_item => $item){

        //verifica se item disponível hoje e agora
        if(
            $item->getDias_semana() &&
            in_array($hoje, json_decode($item->getDias_semana())) &&
            ($hora_atual >= $item->getCardapio_horas_inicio() && $hora_atual < $item->getCardapio_horas_final())
        ){

            $categoria_com_itens++;

            echo
            "<div class='produto'>
                <div class='imagem'>
                    
                    <img class='img-responsive' title='".$item->getNome()."' alt='".$item->getNome()."' src='../admin/".$item->getFoto()."'>
                </div>
                <div class='descricao'>

                    <div class='tituloNome' id='tituloNome".$item->getCod_cardapio()."'>".$item->getNome()."</div>
                    <div class='textoDescricao'>".html_entity_decode($item->getDescricao())."</div>
                    <div class='textoDelivery'> Delivery: ". $item->getDsDelivery()."</div>
                    
                    <div class='preco'><strong>R$ ".$item->getPreco()."</strong></div>
                    
                    <button  id='addCarrinho' data-url='ajax/add-carrinho.php' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar</button><br>
                    <button id='addCombo' data-cod='".$item->getCod_cardapio()."' class='btn btn-default'>Adicionar ao Combo</button>
                </div>
            </div>";
        }
    }

    if($categoria_com_itens == 0){
        echo '<div style="text-align:center; padding-bottom:10px;">Itens indisponíveis no momento! <i class="far fa-surprise"></i></div>';
    }

}
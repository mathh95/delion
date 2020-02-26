<?php
session_start();

ini_set('display_errors', true);
date_default_timezone_set('America/Sao_Paulo');

include_once "../../admin/controler/conexao.php";
include_once "../controler/controlProduto.php";
include_once "../controler/controlCategoria.php";
include_once "../controler/controlAdicional.php";
include_once MODELPATH."/adicional.php";
include_once "../lib/alert.php";

$controleAdicional = new controlerAdicional(conecta());


if(isset($_GET['search']) && !empty($_GET['search'])){
    $busca = addslashes(htmlspecialchars($_GET['search']));
}else{
    $busca = "";
}

$controle_categoria = new controlerCategoria(conecta());
$controle_produto = new controlerProduto(conecta());

// ============================================
// Monta outra consulta MySQL para a busca
if (isset($_GET['delivery']) && !empty($_GET['delivery'])) {
    $delivery = $_GET['delivery'];
} else {
    $delivery = false;
}

//para Paginação
// if ($delivery == true ){
//     $quantidade = $controle_produto->selectDelivery($busca,1);
// }else{
//     $quantidade = $controle_produto->select($busca,1);
//     //cria outra busca aqui
// }


$categorias = $controle_categoria->selectAllByPos();
//itens por categoria ordenados
foreach ($categorias as $key_cat => $categoria) {

    echo 
        "<div class='categoria' id='categoria".$categoria->getPkId()."' >
                <img style='display:none;' src='../admin/".$categoria->getIcone()."' onload='this.style.display=\"inline\"'/>
                <b>".$categoria->getNome()."</b>
        </div>";
    

    $itens = $controle_produto->selectByCategoriaByPosServindo(
        $categoria->getPkId()
    );

    // $hora_atual = date('H:i:s', time() - 3600);// horário de verão extinto
    $hora_atual = date('H:i:s', time());// servidor possui hora correta
    $hoje = (date('w')+1); // 1 == domingo, 7 == sábado
    
    $categoria_com_itens = 0;
    foreach ($itens as $key_item => $item){
        
        // verifica se item disponível hoje e agora
        if(
            $item->getFlag_ativo()
        ){

            $categoria_com_itens++;

            echo
            "<div class='produto'>

                <div class='imagem'>
                    
                    <img class='img-responsive' title='".$item->getNome()."' alt='".$item->getNome()."' src='../admin/".$item->getFoto()."' onerror='this.src=\"/home/img/default_produto.jpg\"'>
                </div>

                <div class='descricao'>

                    <div class='tituloNome' id='tituloNome".$item->getPkId()."'>".$item->getNome()."</div>
                    
                    <div class='textoDescricao'>".html_entity_decode($item->getDescricao())."</div>
                    <div class='textoDelivery'> Delivery: ". $item->getDsDelivery()."</div>
                
                    <div id='preco-add' class='pull-right'>
                        <strong  class='preco'>R$ ".$item->getPreco()."</strong>";
                        
                        //se disponível habilita compra
                        if(
                            $item->getDias_semana() &&
                            in_array($hoje, json_decode($item->getDias_semana())) &&
                            ($hora_atual >= $item->getProduto_horas_inicio() &&
                            $hora_atual < $item->getProduto_horas_final()) &&
                            $item->getFlag_servindo()
                        ){
                            
                            echo "<button id='addCarrinho' data-cod='".$item->getPkId()."' class='btn btn-default'>Adicionar</button>";

                        }else{
                            echo "<button id='addCarrinho' data-cod='".$item->getPkId()."' class='btn btn-default' disabled title='Indísponível 👩‍🍳'>Indisponível 👩‍🍳</button>";
                        }

                    echo "</div>

                    <br>
                </div>
            </div>";
        }
    }

    if($categoria_com_itens == 0){
        echo '<div style="text-align:center; padding-bottom:10px;">Itens indisponíveis no momento! <i class="far fa-surprise"></i></div>';
    }
}
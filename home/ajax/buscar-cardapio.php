<?php
session_start();

ini_set('display_errors', true);
date_default_timezone_set('America/Sao_Paulo');

include_once "../../admin/controler/conexao.php";
include_once "../controler/controlProduto.php";
include_once "../controler/controlCategoria.php";
include_once "../controler/controlAdicional.php";
include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";
include_once MODELPATH."/adicional.php";
include_once "../configuracaoCores.php";

include_once CONTROLLERPATH ."/controlFaixaHorario.php";
$controle_faixa_horario = new controlerFaixaHorario(conecta());

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
        "<div class='categoria' id='categoria".$categoria->getPkId()."' style='background-color:".$corPrim."; border-bottom: 5px solid ".$corSec.";'>
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
        
        // verifica se item disponível
        if(
            $item->getFlag_ativo()
        ){

            $categoria_com_itens++;

            echo
            "<div class='produto'>

                <div class='imagem'>
                    
                    <img class='img-responsive' title='".$item->getNome()." - Delivery Foz do Iguaçu' alt='".$item->getNome()."' src='../admin/".$item->getFoto()."' onerror='this.src=\"/home/img/default_produto.jpg\"' style='border-right: 1px solid ".$corSec.";'>
                </div>

                <div class='descricao'>

                    <div class='tituloNome' id='tituloNome".$item->getPkId()."'>".$item->getNome()."</div>
                    
                    <div class='textoDescricao'>".html_entity_decode($item->getDescricao())."</div>
                    <div class='textoDelivery'> Delivery: ". $item->getDsDelivery()."</div>
                
                    <div id='preco-add' class='pull-right'>
                        <strong  class='preco'>R$ ".$item->getPreco()."</strong>";


                        $disponivel_agora = false;
                        $arr_dias_disponiveis = $item->getDias_semana();

                        $faixas_horario = $controle_faixa_horario->selectByFkProduto($item->getPkId());
                        
                        // Se disponível todos os horários
                        if (count($faixas_horario) == 0) {
                            $disponivel_agora = true;
                        }
                        // Se disponível agora(horário)
                        foreach ($faixas_horario as $key_fh => $faixa) {
                            
                            if (
                                ($hora_atual >= $faixa->getInicio() &&
                                $hora_atual < $faixa->getFinal())
                            ) {
                                $disponivel_agora = true;
                            }
                        }
                        // Se disponível hoje e agora(horário) 
                        if (
                            $arr_dias_disponiveis &&
                            in_array($hoje, json_decode($arr_dias_disponiveis)) &&
                            $item->getFlag_servindo() &&
                            $disponivel_agora
                        ) {
                            $disponivel_agora = true;
                        }else{
                            $disponivel_agora = false;
                        }
                        
                // if($disponivel_agora){
                //     echo "<button id='addCarrinho' data-cod='".$item->getPkId()."' class='btn btn-default' data-src_image='../admin/".$item->getFoto()."' data-arr_adicionais='".$item->getAdicional()."' style='background-color:".$corSec."; border: 1px solid ".$corPrim."'>Adicionar</button>";
                    
                // }
                        if($disponivel_agora && $categoria->getPkId() == 45){
                            echo "<button id='addCarrinhoPizza' data-cod='".$item->getPkId()."' class='btn btn-default' data-src_image='../admin/".$item->getFoto()."' data-arr_adicionais='".$item->getAdicional()."' style='background-color:".$corSec."; border: 1px solid ".$corPrim."'>Adicionar</button>";
                        }
                        else if ($disponivel_agora && $categoria->getPkId() != 45){
                            echo "<button id='addCarrinho' data-cod='".$item->getPkId()."' class='btn btn-default' data-src_image='../admin/".$item->getFoto()."' data-arr_adicionais='".$item->getAdicional()."' style='background-color:".$corSec."; border: 1px solid ".$corPrim."'>Adicionar</button>";

                        }
                        else{
                            echo "<button id='addCarrinho' data-cod='".$item->getPkId()."' class='btn btn-default' disabled title='Indísponível 👩‍🍳' style='background-color:".$corSec."; border: 1px solid ".$corPrim."'>Indisponível 👩‍🍳</button>";
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
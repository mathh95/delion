<?php
session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCombo.php";

require_once "../controler/controlCardapio.php";

require_once "../controler/controlAdicional.php";

include_once "../lib/alert.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
$controleAdicional = new controlerAdicional(conecta());
// $pedido = new enviarEmailPedido;
if(isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery']=$_GET['delivery'];
}else{
    $_SESSION['delivery']=-1;
}


if(isset($_SESSION['combo']) && !empty($_SESSION['combo'])){
    $itensSessao = $_SESSION['combo'];
    $adicionaisSessao = $_SESSION['adicionalCombo'];

    // print_r($itens);
    // print_r($adicionais);
    // exit;
}else{
    $_SESSION['combo'] = array();
    $_SESSION['adicionalCombo'] = array();
}
if(count($itensSessao) > 0){
    $itens = array();
    foreach($itensSessao as $itemSessao){
        array_push($itens, $cardapio->selectsemCategoria($itemSessao, 2)); 
    }

    // print_r($itens);
    // exit;
?>
        <!-- <script type="text/javascript" src="js/buscar-delivery-combo.js"></script>
        <script type="text/javascript" src="js/buscar-combo.js"></script> -->
        <h1 class="text-center">Combo</h1>
        <div class="combo row">
            <table class="tabela_itens table table-hover table-responsive table-condensed">
                <thead>
                    <tr id="cabecalhoTabela" >
                        <th>Foto</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Adicionais</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php $total = 0; 
                $i = 0;
                $pedidoBalcao=0;
                foreach($itens as $item): 
                    $adicionais = $controleAdicional->buscarVariosId(json_decode($item->getAdicional()));
                    // print_r($adicionais);exit;
                    $perc = $item->getDesconto() / 100;
                    $perc = $item->getPreco() * $perc;
                    $total += $item->getPreco() - $perc;?>
                    <tr id="idLinha<?=$i?>" data-id="<?=$item->getCod_cardapio()?>">
                        <td><img style="width:200px; height:100px;" src="../admin/<?=$item->getFoto()?>"></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?=$item->getNome()?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?=$i?>" data-desconto="<?=$item->getDesconto()?>" data-preco="<?=$item->getPreco()?>"><strong>R$ <?=number_format($item->getPreco(), 2);?></strong></td>
                        <td style="font-size:10px;">
                            <table>
                                <?php
                                    $j = 0;
                                    echo "<tr>";
                                    foreach($adicionais as $adicional){
                                        if(in_array($adicional['cod_adicional'], $adicionaisSessao[$i])){
                                            echo "<td><input checked type='checkbox' name='adicional' value='".$adicional['cod_adicional']."'> <strong>".$adicional['nome']."</strong>";
                                            echo "(R$: ".$adicional['preco'].") </td>";
                                        }else{
                                            echo "<td><input type='checkbox' name='adicional' value='".$adicional['cod_adicional']."'> <strong>".$adicional['nome']."</strong>";
                                            echo "(R$: ".$adicional['preco'].") </td>";
                                        }
                                        $j++;
                                        if($j == 2){
                                            echo "</tr>";
                                            $j = 0;
                                        }
                                    }
                                    echo "</tr>";
                                ?>
                            </table>
                        </tr>
                        <!-- <td class="subtotalProdutoTabela" id="subtotal<?php//echo $i?>"><strong>R$ <?php //echo number_format($item['preco'] - $perc, 2);?></strong></td> -->
                        <td class="nomeProdutoTabela"><strong><?php if($item->getDelivery() == 1){
                            echo "Disponível";
                            }else{
                            echo "Não disponível";
                            $pedidoBalcao=$pedidoBalcao + 1;
                            }?></strong> </td>
                    </tr>
            <?php $i++;
            endforeach;
            $_SESSION['totalCombo'] = $total;
            $_SESSION['pedidoBalcaoCombo']=$pedidoBalcao;   
    echo "</tbody>
        </table>
        </div>
        <div class='rodapeCarrinho row'>
            <div class='ladoEsquerdo'>                    
                <strong><p>Escolha como vai receber o pedido: </p>
                </strong>
                <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-primary' id='delivery' onclick='tipoPedido(1)'>
                        <input type='radio' name='delivery'  autocomplete='off'> Delivery
                    </label>
                    <label class='btn btn-primary'  id='balcao' onclick='tipoPedido(-1)'>
                        <input type='radio' name='balcao' autocomplete='off'> Balcão
                    </label>
                </div>
            </div>
            <div class='ladoDireito row'>
                <strong><p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)." 
                </p></strong>
                <div class='row linhaBotao'>
                        <a class='botaoCarrinhoEnviar' href='../home/ajax/enviarEmailCombo.php'><button id='finalizar' class='btn'>Finalizar pedido <i class='far fa-envelope fa-adjust'></i></button></a>
                        <a class='botaoCarrinhoEsvaziar' onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger'>Esvaziar carrinho <i class='fas fa-trash-alt'></i></button></a>
                </div>
            </div>
        </div>";
    
        

// $pedido->finalizarPedido();

}else{
    echo "<div class='container row carrinhoVazio' style='margin:20px;'>
            <div class='imagemCarrinhoVazio'>
                <img src='img/carrinho_vazio.png'>
            </div>
            <div class='textoCarrinhoVazio'>
                <h1 class='text-left tituloCarrinhoVazio'>Seu combo ainda está vazio!!</h1>
                <p>Quer conhecer nossos produtos ? Dê uma olhada no nosso cardápio, você pode pedir antecipado, ou pedir para entregar, confira!</p>
            </div>
          </div>";
          
}

?>

<!-- <script>

    

</script> -->
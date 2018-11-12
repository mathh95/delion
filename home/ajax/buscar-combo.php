<?php
// session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');

include_once "../../admin/model/endereco.php";

include_once "../controler/controlEndereco.php";

include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCombo.php";

require_once "../controler/controlCardapio.php";

require_once "../controler/controlAdicional.php";

include_once "../lib/alert.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$adicionaisSessao = array();
$itensSessao = array();
$cardapio = new controlerCardapio(conecta());
$controleAdicional = new controlerAdicional(conecta());
$controlEndereco = new controlEndereco(conecta());
// $pedido = new enviarEmailPedido;
if(isset($_SESSION['cod_endereco']) && !empty($_SESSION['cod_endereco'])){
    $_SESSION['delivery']=1;
}else{
    $_SESSION['delivery']=-1;
}

if(isset($_SESSION['cod_endereco']) && !empty($_SESSION['cod_endereco'])){
    $codEnd = $_SESSION['cod_endereco'];
    $codEnd = $controlEndereco->select($codEnd, 1);
    // echo '<pre>';
    // print_r($codEnd);
    // echo '</pre>';
    // exit;
}else{
    $codEnd = null;
}

// session_destroy();


if(isset($_SESSION['combo']) && !empty($_SESSION['combo'])){
    $itensSessao = $_SESSION['combo'];
    $adicionaisSessao = $_SESSION['adicionalCombo'];
    $_SESSION['totalCombo'] = 0;

    // echo '<pre>';
    // print_r($adicionaisSessao);
    // echo '</pre>';
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
        <script type="text/javascript" src="js/buscar-delivery-combo.js"></script>
        <script type="text/javascript" src="js/buscar-combo.js"></script>
        <h1 class="text-center">Combo</h1>
        <div class="combo row">
            <table class="tabela_itens table table-hover table-responsive table-condensed">
                <thead>
                    <tr id="cabecalhoTabela" >
                        <th class="hidden-xs">Foto</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Adicionais</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php 
                $i = 0;
                $pedidoBalcao=0;
                foreach($itens as $item): 
                    $desconto = 0;
                    if(!empty($item->getAdicional())){
                        $adicionais = $controleAdicional->buscarVariosId(json_decode($item->getAdicional()));
                    }else{
                        $adicionais = array();
                    }
                    // print_r($adicionais);exit;
                    $desconto = $item->getDesconto();
                    $subtotal = $item->getPreco();
                    ?>
                    <tr id="idLinha<?=$i?>" class="produto" data-id="<?=$item->getCod_cardapio()?>">
                        <td class="hidden-xs"><img style="width:200px; height:100px;" src="../admin/<?=$item->getFoto()?>"></td>
                        <td class="nomeProdutoTabela"><strong><?=$item->getNome()?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?=$i?>" data-desconto="<?=$item->getDesconto()?>" data-preco="<?=$item->getPreco()?>"><strong>R$ <?=number_format($item->getPreco(), 2);?></strong></td>
                        <td style="font-size:10px;">
                            <table>
                                <tr>
                                <?php
                                    $j = 0;
                                    foreach($adicionais as $adicional){
                                        if(!empty($adicionaisSessao[$i])){
                                            if(in_array($adicional['cod_adicional'], $adicionaisSessao[$i])){
                                                $subtotal += $adicional['preco'];
                                                $desconto += $adicional['desconto'];
                                                // echo $subtotal."<br>";
                                                echo "<td><input checked data-linha='".$i."' data-subtotal='".$subtotal."' data-preco='".$adicional['preco']."' data-desconto='".$adicional['desconto']."' type='checkbox' id='adicional' name='adicional".$i."' value='".$adicional['cod_adicional']."'> <strong>".$adicional['nome']."</strong>";
                                                echo "(R$: ".$adicional['preco'].") </td>";
                                            }else{
                                                echo "<td><input data-linha='".$i."' data-subtotal='".$subtotal."' data-preco='".$adicional['preco']."' data-desconto='".$adicional['desconto']."' type='checkbox' id='adicional' name='adicional".$i."' value='".$adicional['cod_adicional']."'> <strong>".$adicional['nome']."</strong>";
                                                echo "(R$: ".$adicional['preco'].") </td>";
                                            }
                                        }else{
                                            echo "<td><input data-linha='".$i."' data-subtotal='".$subtotal."' data-preco='".$adicional['preco']."' data-desconto='".$adicional['desconto']."' type='checkbox' id='adicional' name='adicional".$i."' value='".$adicional['cod_adicional']."'> <strong>".$adicional['nome']."</strong>";
                                            echo "(R$: ".$adicional['preco'].") </td>";
                                            // echo "<p>Esse produto não possui adicionais!!</p>";
                                        }
                                        $j++;
                                        if($j == 1){
                                            echo "</tr>";
                                            $j = 0;
                                        }
                                    }
                                ?>
                            </table>
                        
                        <!-- <td class="subtotalProdutoTabela" id="subtotal<?php//echo $i?>"><strong>R$ <?php //echo number_format($item['preco'] - $perc, 2);?></strong></td> -->
                        <td><strong><?php if($item->getDelivery() == 1){
                            echo "Disponível<br><br>
                            <button id='removeCombo' data-linha='".$i."' data-cod='".$item->getCod_cardapio()."' class='btn btn-danger'>Retirar do combo</button>";
                            }else{
                            echo "Não disponível<br><br>
                            <button id='removeCombo' data-linha='".$i."' data-cod='".$item->getCod_cardapio()."' class='btn btn-danger'>Retirar do combo</button>";
                            $pedidoBalcao=$pedidoBalcao + 1;
                            }?></strong> </td>
                    </tr>
            <?php
            echo "</tr>";
            echo "<input type='hidden' id='sub".$i."' value='".$subtotal."'>";
            echo "<input type='hidden' id='desc".$i."' value='".$desconto."'>";
            $descontoFinal = $desconto / 100;
            $descontoFinal = $descontoFinal * $subtotal;
            $subtotalFinal = $subtotal - $descontoFinal; 
            $i++;
            $_SESSION['totalCombo']+= $subtotalFinal;
            endforeach;
            $_SESSION['pedidoBalcaoCombo']=$pedidoBalcao;   
    echo "</tbody>
        </table>
        </div>";

    if($codEnd != null){
        echo "<div id='end' style='margin-left:10px;' class='endereco row'>
            <h3 id='tituloEndereco'>Endereço selecionado:</h3><br>
            <strong><p id='endereco'>Rua: ".$codEnd[0]->getRua()." Nº ".$codEnd[0]->getNumero()."</p></strong>
            <a href='/home/endereco.php'><button class='btn btn-info'>Alterar Endereço</button></a>
        </div><hr>";
    }
    if($codEnd != null){
        echo "<div class='rodapeCarrinho row'>
            <div class='ladoEsquerdo'>                    
                <strong><p>Escolha como vai receber o pedido: </p>
                </strong>
                <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-primary active' id='delivery' onclick='tipoPedido(1)'>
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
                        <a class='botaoCarrinhoEnviar' href='#'><button id='finalizar' class='btn'>Finalizar pedido <i class='far fa-envelope fa-adjust'></i></button></a>
                        <a class='botaoCarrinhoEsvaziar' onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger'>Esvaziar carrinho <i class='fas fa-trash-alt'></i></button></a>
                </div>
            </div>
        </div>";
    }else{
        echo "<div class='rodapeCarrinho row'>
            <div class='ladoEsquerdo'>                    
                <strong><p>Escolha como vai receber o pedido: </p>
                </strong>
                <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-primary' id='delivery' onclick='tipoPedido(1)'>
                        <input type='radio' name='delivery'  autocomplete='off'> Delivery
                    </label>
                    <label class='btn btn-primary active'  id='balcao' onclick='tipoPedido(-1)'>
                        <input type='radio' name='balcao' autocomplete='off'> Balcão
                    </label>
                </div>
            </div>
            <div class='ladoDireito row'>
                <strong><p id='total'>Valor total do pedido: R$".number_format($_SESSION['totalCombo'], 2)." 
                </p></strong>
                <div class='row linhaBotao'>
                        <a class='botaoCarrinhoEnviar' href='#'><button id='finalizar' class='btn'>Finalizar pedido <i class='far fa-envelope fa-adjust'></i></button></a>
                        <a class='botaoCarrinhoEsvaziar' onclick='esvaziar()' href='cardapio.php'><button class='btn btn-danger'>Esvaziar carrinho <i class='fas fa-trash-alt'></i></button></a>
                </div>
            </div>
        </div>";
    }
    

        // print_r($_SESSION['totalCombo']);
    
        

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
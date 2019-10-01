<?php
session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";

include_once "../../admin/controler/controlFormaPgt.php";

include_once "../../admin/model/formaPgt.php";

include_once "../utils/distanceMatrix.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
$_SESSION['delivery'] = -1;
$_SESSION['formaPagamento'] = '';
$controlFormaPgt = new controlerFormaPgt($_SG['link']);
$formasPgt = $controlFormaPgt->selectAll();
$_SESSION['delivery_price'] = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $itens = $_SESSION['carrinho'];
    foreach ($_SESSION['qtd'] as $key => $value) {
        $_SESSION['qtd'][$key] = 1;
    }
} else {
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $itens = $_SESSION['carrinho'];
}

if (count($itens) > 0) {

    $itens = $cardapio->buscarVariosId($itens);
    ?>
    <script type="text/javascript" src="js/buscar-delivery.js"></script>
    <script type="text/javascript" src="js/buscar-carrinho.js"></script>
    <h1 class="text-center">Pedido</h1>
    <?php //print_r($_SESSION['qtd']); 
        ?>
    <?php //print_r($_SESSION['carrinho']); 
        ?>
    <div class="carrinho row">
        <table class="tabela_itens table table-hover table-responsive table-condensed">
            <thead>
                <tr id="cabecalhoTabela">
                    <th>Excluir</th>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Quantidade</th>
                    <th>Delivery</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $totalCarrinho = 0;
                    $i = 0;
                    $pedidoBalcao = 0;
                    foreach ($itens as $item) : ?>
                    <tr id="idLinha<?= $i ?>" data-id="<?= $item['cod_cardapio'] ?>">
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?= $i ?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?= $item['nome'] ?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?= $i ?>" data-preco="<?= $item['preco'] ?>"><strong>R$ <?= number_format($item['preco'], 2); ?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?= $i ?>"><strong>R$ <?= number_format($item['preco'], 2); ?></strong></td>
                        <td class="quantidadeProdutoTabela">
                            <input class="quantidadeItemTabela" id="qtdUnidade<?= $i ?>" name="quantidade" type="text" value=1 readonly="true">
                            <i id="adicionarUnidade" data-toggle="tooltip" title="Adicione 1." data-linha="<?= $i ?>" class="fas fa-cart-plus fa-lg btn iconeAdicionarProdutoTabela"></i>
                            <i id="removerUnidade" data-toggle="tooltip" title="Remove 1." data-linha="<?= $i ?>" class="fas fa-cart-arrow-down fa-lg btn iconeExcluirProdutoTabela"></i>
                        </td>
                        <td class="nomeProdutoTabela"><strong>
                                <?php
                                        if ($item['delivery'] == 1) {
                                            echo "Disponível";
                                        } else {
                                            echo "Não disponível";
                                            $pedidoBalcao = $pedidoBalcao + 1;
                                        }
                                        ?>
                            </strong> </td>
                    </tr>
                <?php
                        $i++;
                        $totalCarrinho += $item['preco'];
                    endforeach;
                    $_SESSION['totalCarrinho'] = $totalCarrinho;
                    $_SESSION['pedidoBalcao'] = $pedidoBalcao;
                    ?>
            </tbody>
        </table>
    </div>
    <div class="rodapeCarrinho row">
        <div class='ladoEsquerdo'>
            <strong>
                <p>Forma de Pagamento</p>
            </strong>
            <div class="input-group">
                <select name="formaPagamento" id="formaPagamento" class="form-control">
                    <option value="0">Dinheiro</option>
                    <?php
                        foreach ($formasPgt as $formaPgt) {
                            if ($formaPgt->getFlag_ativo() == 1) {
                                echo "<option value ='" . $formaPgt->getCod_formaPgt() . "'>" . $formaPgt->getTipoFormaPgt() . "</option>";
                            }
                        }
                        ?>
                </select>
            </div>

            <?php
                if (!isset($_SESSION['valorcupom'])) {
                    $_SESSION['valorcupom'] = 0.00;
                    $_SESSION['totalComDesconto'] = 0.00;
                }

                $totalDesc = $_SESSION['totalCarrinho'] - $_SESSION['valorcupom'];
                $totalDesc = $totalDesc <= 0 ? number_format(0, 2) : number_format($totalDesc, 2);

                $_SESSION['totalCorrigido'] = $totalDesc;
                $_SESSION['totalComDesconto'] = $totalDesc;


                if ($_SESSION['valorcupom'] == 0) {
                    echo "<div>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <input type='text' name='codigocupom' id='codigocupom'>
                        <a class='botaoAdicionarCupom' onclick='adicionarCupom()'><button id='adicionarCupom' class='btn btn-danger'>Adicionar <i class='fa fa-ticket-alt fa-adjust'></i></button></a>    
                    </div>";
                } else {
                    echo "<div>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <input type='text' name='codigocupomrem' id='codigocupomrem' disabled>
                        <a class='botaoAdicionarCupom' onclick='removerCupom()'><button id='removerCupom' class='btn btn-danger'>Remover Cupom<i class='fas fa-trash-alt fa-adjust'></i></button></a>    
                    </div>";
                }

                //Endereço inserido na página inicial
                if (isset($_SESSION['endereco']['postal_code']) || ($_SESSION['is_delivery'] != 0)) {

                    $_SESSION['is_delivery'] = 1;

                    //taxa de entrega calculada?
                    if (($_SESSION['delivery_price'] > 0) && ($_SESSION['is_delivery'])) {
                        $_SESSION['totalCorrigido'] += $_SESSION['delivery_price'];
                    }

                    //delivery active
                    echo "<strong><p>Entrega</p></strong>
                    <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-danger active' id='delivery' onclick='tipoPedido(1)'>
                    <input type='radio' name='delivery' autocomplete='off'> Delivery&nbsp;<i class='fas fa-shipping-fast'></i></label>
                    <label class='btn btn-danger' id='balcao' onclick='tipoPedido(-1)'>
                    <input type='radio' name='balcao' autocomplete='off'> Balcão&nbsp;<i class='fas fa-store'></i>
                    </label>
                    </div>";

                    //var_dump($_SESSION['endereco']);

                    $admin_area_lv1 = $_SESSION['endereco']['administrative_area_level_1'];
                    $admin_area_lv2 = $_SESSION['endereco']['administrative_area_level_2'];
                    $postal_code = $_SESSION['endereco']['postal_code'];
                    $sublocality_lv1 = $_SESSION['endereco']['sublocality_level_1'];
                    $route = $_SESSION['endereco']['route'];
                    $street_number = $_SESSION['endereco']['street_number'];
                    $complemento = $_SESSION['endereco']['complemento'];
                    $referencia = $_SESSION['endereco']['referencia'];

                    echo "<div id='infoDelivery'>";
                    echo "<br><span style='font-weight:bold;'>Endereço para Entrega: </span> <span onclick='location=\"/home\"' style='cursor:pointer;'><i class='fas fa-edit'></i>&nbsp;Alterar</span><br><br>";
                    echo "CEP: " . $postal_code . "<br>";
                    echo "End.: " . $route . "<br>";
                    echo "Número: " . $street_number . "<br>";
                    if (strlen($complemento) > 0) {
                        echo "Complemento: " . $complemento . "<br>";
                    } else {
                        echo "Complemento: (vazio)<br>";
                    }
                    echo "Bairro: " . $sublocality_lv1 . "<br>";
                    echo "Cidade: " . $admin_area_lv2 . "<br>";
                    //echo "UF: ".$admin_area_lv1."<br>";
                    if (strlen($referencia) > 0) {
                        echo "Ponto de Referência: " . $referencia . "<br>";
                    } else {
                        echo "Ponto de Referência: (vazio)<br>";
                    }

                    $distanceMatrix = new DistanceMatrix();

                    $origin = "R. Jorge Sanwais, 1137 - Centro, Foz do Iguaçu"; //-25.54086,-54.581167
                    $dest = $route . " " . $street_number . " " . $sublocality_lv1 . " " . $admin_area_lv2;

                    $dist = $distanceMatrix->getDistanceInfo($origin, $dest); //origin,dest
                    echo "<br>Distância: " . $dist['distance_km'] . " <br>";
                    echo "Tempo estimado de entrega: " . $dist['duration'] . " <br>";
                    $delivery_price = $distanceMatrix->getDeliveryPrice($dist['distance_meters']);
                    $_SESSION['delivery_price'] = $delivery_price;
                    echo "</div>";

                    $_SESSION['delivery_time'] = $dist['duration'];
                    $_SESSION['totalCorrigido'] += $delivery_price;

                    //balcao
                    echo "<div style='display:none;' id='infoBalcao'>";
                    echo "<br><span style='font-weight:bold;'>Endereço para Retirada: </span> <br><br>";
                    echo "CEP: 85851-150<br>";
                    echo "End.: Rua Jorge Sanwais<br>";
                    echo "Número: 1137<br>";
                    echo "Bairro: Centro<br>";
                    echo "Cidade: Foz do Iguaçu<br>";
                    echo "</div>";
                } else {

                    $_SESSION['is_delivery'] = 0;

                    //balcão active
                    echo "<strong><p>Entrega</p></strong>
                    <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-danger' id='delivery' onclick='tipoPedido(1)'>
                    <input type='radio' name='delivery' autocomplete='off'> Delivery&nbsp;<i class='fas fa-shipping-fast'></i></label>
                    <label class='btn btn-danger active' id='balcao' onclick='tipoPedido(-1)'>
                    <input type='radio' name='balcao' autocomplete='off'> Balcão&nbsp;<i class='fas fa-store'></i>
                    </label>
                    </div>";

                    echo "<div id='infoBalcao'>";
                    echo "<br><span style='font-weight:bold;'>Endereço para Retirada: </span> <br><br>";
                    echo "CEP: 85851-150<br>";
                    echo "End.: Rua Jorge Sanwais<br>";
                    echo "Número: 1137<br>";
                    echo "Bairro: Centro<br>";
                    echo "Cidade: Foz do Iguaçu<br>";
                    echo "</div>";
                }


                echo "</div>                    
                    <div class='ladoDireito row'>
                    <p id='subTotal'>Subtotal: R$ <span id='valor_subTotal'>" . number_format($_SESSION['totalCarrinho'], 2) . " </span></p>
                    <p id='entrega'>Taxa de Entrega: R$ <span id='valor_taxa_entrega'>" . number_format($_SESSION['delivery_price'], 2) . "</span></p>
                    <p id='desconto'>Desconto: R$ <span id='valor_desconto'> " . number_format($_SESSION['valorcupom'], 2) . "</span></p> 
                    <strong><p id='total'> Total: R$ <span id='valor_total'>" . number_format($_SESSION['totalCorrigido'], 2) . "</span></p></strong>
                    
                    <div class='linhaBotao'>
                    <a class='botaoCarrinhoEnviar' href='../home/controler/validaPedido.php'><button id='finalizar' class='btn'>Finalizar Pedido <i class='far fa-envelope fa-adjust'></i></button></a>
                    <a class='botaoCarrinhoEsvaziar' onclick='esvaziar()'><button class='btn btn-danger'>Esvaziar Carrinho <i class='fas fa-trash-alt'></i></button></a>
                    </div>
                    </div>
                    </div>";
                ?>
        </div>
    </div>


<?php
} else {
    echo "<div class='container row carrinhoVazio' style='margin:20px;'>
    <div class='imagemCarrinhoVazio'>
    <img src='img/carrinho_vazio.png'>
    </div>
    <div class='textoCarrinhoVazio'>
        <h1 class='text-left tituloCarrinhoVazio'>Seu carrinho ainda está vazio!!</h1>
        <p>Quer conhecer nossos produtos ? Dê uma olhada no nosso cardápio, você pode pedir antecipado, ou pedir para entregar, confira!</p>
    </div>
    </div>";
}
?>
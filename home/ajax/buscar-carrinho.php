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

include_once "../utils/googleServices.php";

include_once "../controler/controlEmpresa.php";

include_once "../../admin/model/entrega.php";

include_once "../../admin/controler/controlEntrega.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
$_SESSION['delivery'] = -1;
$_SESSION['formaPagamento'] = '';
$controlFormaPgt = new controlerFormaPgt($_SG['link']);
$formasPgt = $controlFormaPgt->selectAll();
$_SESSION['delivery_price'] = 0;
$_SESSION['delivery_time'] = 0;

//zera flag Finalizar pedido
$_SESSION['finalizar_pedido'] = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $itens = $_SESSION['carrinho'];
    
    //seta unidade de itens p/ 1 unidade
    // if(!isset($_SESSION['qtd'])){
    //     foreach ($_SESSION['qtd'] as $key => $value) {
    //         $_SESSION['qtd'][$key] = 1;
    //     }
    // }

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
                    foreach ($itens as $key => $item) : ?>
                    <tr id="idLinha<?= $i ?>" data-id="<?= $item['cod_cardapio'] ?>">
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?= $i ?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?= $item['nome'] ?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?= $i ?>" data-preco="<?= $item['preco'] ?>"><strong>R$ <?= number_format($item['preco'], 2); ?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?= $i ?>"><strong>R$ <?= number_format($item['preco'], 2); ?></strong></td>
                        <td class="quantidadeProdutoTabela">
                            <input class="quantidadeItemTabela" id="qtdUnidade<?= $i ?>" name="quantidade" type="text" value=<?= $_SESSION['qtd'][$key] ?> readonly="true">
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
                        $totalCarrinho += $item['preco'] * $_SESSION['qtd'][$key];
                    endforeach;
                    $_SESSION['totalCarrinho'] = $totalCarrinho;
                    $_SESSION['pedidoBalcao'] = $pedidoBalcao;
                    ?>
            </tbody>
        </table>
    </div>
    <hr>

    <!-- Lado Esquerdo -->
    <div class="rodapeCarrinho row">
        <div class='ladoEsquerdo'>

            <?php
                if (!isset($_SESSION['valorcupom'])) {
                    $_SESSION['valorcupom'] = 0.00;
                    $_SESSION['totalComDesconto'] = 0.00;
                }

                $totalDesc = $_SESSION['totalCarrinho'] - $_SESSION['valorcupom'];
                $totalDesc = $totalDesc <= 0 ? number_format(0, 2) : number_format($totalDesc, 2);

                $_SESSION['totalCorrigido'] = $totalDesc;
                $_SESSION['totalComDesconto'] = $totalDesc;


                if(isset($_SESSION['endereco']['postal_code'])){
                    $_SESSION['is_delivery'] = 1;
                    //unset($_SESSION['endereco']);
                }else if(!isset($_SESSION['is_delivery'])){//se setado mantem valor
                    $_SESSION['is_delivery'] = 0;
                }
                //unset($_SESSION['is_delivery']);
                
                $_SESSION['entrega_valida'] = 0;

                if (($_SESSION['is_delivery'] == 1)) {
                    //taxa de entrega calculada?
                    if (($_SESSION['delivery_price'] > 0) && ($_SESSION['is_delivery'])) {
                        $_SESSION['totalCorrigido'] += $_SESSION['delivery_price'];
                    }
                    
                    //delivery active
                    echo "
                    <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-danger active' id='delivery' onclick='tipoPedido(1)'>
                    <input type='radio' name='delivery' autocomplete='off'> Delivery&nbsp;<i class='fas fa-shipping-fast'></i></label>
                    <label class='btn btn-danger' id='balcao' onclick='tipoPedido(-1)'>
                    <input type='radio' name='balcao' autocomplete='off'> Balcão&nbsp;<i class='fas fa-store'></i>
                    </label>
                    </div>";
                    
                    //var_dump($_SESSION['endereco']);
                    
                    //Endereço inserido na página inicial
                    if(isset($_SESSION['endereco']['postal_code'])){

                        $cep = $_SESSION['endereco']['postal_code'];
                        $rua = $_SESSION['endereco']['route'];
                        $numero = $_SESSION['endereco']['street_number'];
                        $bairro = $_SESSION['endereco']['sublocality_level_1'];
                        $complemento = $_SESSION['endereco']['complemento'];
                        //$uf = $_SESSION['endereco']['administrative_area_level_1'];
                        $cidade = $_SESSION['endereco']['administrative_area_level_2'];
                        $referencia = $_SESSION['endereco']['referencia'];


                        /*** Estimativas de Tempo, Distância, Taxa de entrega ***/
                        $controleEmpresa=new controlerEmpresa(conecta());
                        $empresa = $controleEmpresa->select(1,2);
                        
                        $endereco_delion = $empresa->getEndereco()." ".$empresa->getCidade();
                        
                        $origin = utf8_decode($endereco_delion); //-25.54086,-54.581167
                        $dest = $rua . " " . $numero . " " . $bairro . " " . $cidade;
                        
                        $googleServices = new GoogleServices();

                        $geoloc_origin = $googleServices->getGeocoding($origin);
                        $geoloc_dest = $googleServices->getGeocoding($dest);

                        $dist_km = $googleServices->getDistanceGeometry($geoloc_origin->lat,$geoloc_origin->lng, $geoloc_dest->lat, $geoloc_dest->lng,"K");

                        $dist_km = number_format($dist_km, 1);
                        
                        // $distMatrix = $googleServices->getDistanceMatrixInfo($origin, $dest);
                        // var_dump($distMatrix);

                        //Get raio/taxas/tempo
                        $controle = new controlEntrega($_SG['link']);
                        $info_entrega = $controle->selectByDist($dist_km);     
                        
                        //Endereço válido para entrega! != -1
                        //um objeto é esperado
                        if(!is_int($info_entrega)){
                            
                            $_SESSION['entrega_valida'] = 1;

                            $estimativa_tempo = $info_entrega->getTempo();
                            $_SESSION['delivery_time'] = floor($estimativa_tempo);//em minutos
                            
                            
                            $delivery_price = $info_entrega->getTaxa_entrega();
                            $_SESSION['delivery_price'] = (float) $delivery_price;
                            
                            $_SESSION['totalCorrigido'] += (float) $delivery_price;


                            //Display info de entrega
                            echo "<div id='infoDelivery'>";
                            echo "<span style='font-weight:bold;'>Endereço para Entrega: </span> <span onclick='location=\"/home\"' style='cursor:pointer;'><i class='fas fa-edit'></i>&nbsp;Alterar</span><br>";
                            echo "CEP: " . $cep . "<br>";
                            echo "End.: " . $rua . "<br>";
                            echo "Número: " . $numero . "<br>";
                            if (strlen($complemento) > 0) {
                                echo "Complemento: " . $complemento . "<br>";
                            } else {
                                echo "Complemento: (vazio)<br>";
                            }
                            echo "Bairro: " . $bairro . "<br>";
                            echo "Cidade: " . $cidade . "<br>";
                            //echo "UF: ".$admin_area_lv1."<br>";
                            if (strlen($referencia) > 0) {
                                echo "Ponto de Referência: " . $referencia . "<br>";
                            } else {
                                echo "Ponto de Referência: (vazio)<br>";
                            }
                            echo "</div>";

                        }else{
                            //Endereço inválido para entrega
                            echo "<div id='infoDelivery'>";
                            echo "<span style='font-weight:bold;'> <i class='fas fa-frown-open'></i>&nbsp;Ops...Ainda não fazemos entrega nesta região: </span><br><br>";

                            echo " <span onclick='location=\"/home\"' style='cursor:pointer;'><i class='fas fa-edit'></i>&nbsp;Alterar</span><br>";
                            echo "End.: " . $rua . "<br>";
                            echo "Número: " . $numero . "<br>";
                            echo "Cidade: " . $cidade . "<br>";
                            echo "</div>";
                        }
                    }else{
                        //info de entrega
                        echo "<div id='infoDelivery'>";
                        echo "<br>";
                        echo "<span style='font-weight:bold;'></span> <span onclick='location=\"/home\"' style='cursor:pointer;'>&nbsp;Inserir Endereço de Entrega&nbsp;<i class='fas fa-external-link-alt'></i></span><br>";
                        echo "<br><span>*Ou selecione um Endereço cadastrado ao Finalizar o Pedido.</span>";
                        echo "</div>";
                    }

                    //balcao
                    echo "<div style='display:none;' id='infoBalcao'>";
                    echo "<span style='font-weight:bold;'>Endereço para Retirada: </span> <br>";
                    echo "CEP: 85851-150<br>";
                    echo "End.: Rua Jorge Sanwais<br>";
                    echo "Número: 1137<br>";
                    echo "Bairro: Centro<br>";
                    echo "Cidade: Foz do Iguaçu<br>";
                    echo "</div></div>";//fecha lado esquerdo

                } else {
                    
                    //balcao
                    $_SESSION['is_delivery'] = 0;
                    
                    //balcão active
                    echo "
                    <div class='btn-group btn-group-toggle' data-toggle='buttons'>
                    <label class='btn btn-danger' id='delivery' onclick='tipoPedido(1)'>
                    <input type='radio' name='delivery' autocomplete='off'> Delivery&nbsp;<i class='fas fa-shipping-fast'></i></label>
                    <label class='btn btn-danger active' id='balcao' onclick='tipoPedido(-1)'>
                    <input type='radio' name='balcao' autocomplete='off'> Balcão&nbsp;<i class='fas fa-store'></i>
                    </label>
                    </div>";

                    //info de entrega
                    echo "<div style='display:none;' id='infoDelivery'>";
                    echo "<br>";
                    echo "<span style='font-weight:bold;'></span> <span onclick='location=\"/home\"' style='cursor:pointer;'>&nbsp;Inserir Endereço de Entrega&nbsp;<i class='fas fa-external-link-alt'></i></span><br>";
                    echo "<br><span>*Ou selecione um Endereço cadastrado ao Finalizar o Pedido.</span>";
                    echo "</div>";


                    //info balcao
                    echo "<div id='infoBalcao'>";
                    echo "<span style='font-weight:bold;'>Endereço para Retirada: </span> <br><br>";
                    echo "CEP: 85851-150<br>";
                    echo "End.: Rua Jorge Sanwais<br>";
                    echo "Número: 1137<br>";
                    echo "Bairro: Centro<br>";
                    echo "Cidade: Foz do Iguaçu<br>";
                    echo "</div></div>";//fecha lado esquerdo
                }


                //meio
                echo "<div class='meio ladoEsquerdo'>";

                if ($_SESSION['valorcupom'] == 0) {
                    echo "<div>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <div class='form-inline'>                            
                            <input class='form-control' type='text' name='codigocupom' id='codigocupom'>
                            <a class='botaoAdicionarCupom' onclick='adicionarCupom()'><button id='adicionarCupom' class='btn btn-danger'>Adicionar <i class='fa fa-ticket-alt fa-adjust'></i></button></a>    
                        </div>
                    </div>";
                } else {
                    echo "<div>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <div class='form-inline'>
                            <input class='form-control' type='text' name='codigocupomrem' id='codigocupomrem' disabled>
                            <a class='botaoAdicionarCupom' onclick='removerCupom()'><button id='removerCupom' class='btn btn-danger'>Remover Cupom<i class='fas fa-trash-alt fa-adjust'></i></button></a> 
                        </div>  
                    </div>";
                }
                ?>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-10">
                        <strong>
                        <p>Forma de Pagamento</p>
                        </strong>
                        <select class="form-control" name="formaPagamento" id="formaPagamento">
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
                </div>
                
                <?php
                
                //Info de Entrega
                if($_SESSION['entrega_valida'] && $_SESSION['is_delivery']){
                    echo "<div id='infoEntrega'>";
                    echo "<br><i class='fas fa-road'></i>&nbsp;Distância da entrega: " . $dist_km . " km <br>";
                    echo "<i class='far fa-clock'></i>&nbsp;Estimativa de preparo/entrega: " . $_SESSION['delivery_time']." mins</div>";
                }

                //Variaveis passadas pra control do carrinho
                $_SESSION['delivery_price_var'] = $_SESSION['delivery_price'];
                
                    $_SESSION['delivery_time_var'] = $_SESSION['delivery_time'];
                
                    $_SESSION['valorcupom_var'] = $_SESSION['valorcupom'];

                echo "</div>";

                
                //Lado direito
                echo "
                    <div class='ladoDireito row'>
                    <p id='subTotal' class='' >Subtotal: R$ <span id='valor_subTotal'>" . number_format($_SESSION['totalCarrinho'], 2) . " </span></p>
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
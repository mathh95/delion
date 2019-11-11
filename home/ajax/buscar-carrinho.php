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

include_once "../utils/GoogleServices.php";

include_once "../controler/controlEmpresa.php";

include_once "../../admin/model/entrega.php";

include_once "../../admin/controler/controlEntrega.php";

include_once "../controler/controlEndereco.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
$cardapioObs = new controlerCardapio(conecta());
$controlEndereco = new controlEndereco(conecta());
$_SESSION['delivery'] = -1;
$_SESSION['formaPagamento'] = '';
$controlFormaPgt = new controlerFormaPgt($_SG['link']);
$formasPgt = $controlFormaPgt->selectAll();
$_SESSION['delivery_price'] = 0;
$_SESSION['delivery_time'] = 0;
$_SESSION['delivery_free'] = 0;
$_SESSION['valor_entrega_valido'] = 0;
$_SESSION['delivery_price_calculado'] = 0;
$_SESSION['minimo_taxa_gratis'] = 99999;


//zera flag Finalizar pedido
$_SESSION['finalizar_pedido'] = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    //ordenados com base na inserção/add carrinho
    $itens = $_SESSION['carrinho'];
    $itensObservacao = $_SESSION['observacao'];
    $itensQtd = $_SESSION['qtd'];

    $itens_fliped = array_flip($itens);

    //itens_fliped -> id no index 
    $itens_fliped_obs = $itens_fliped;
    $i=0;
    //Associa a Observação ao id do item    
    foreach ($itens_fliped as $key => $item_fliped){
        $itens_fliped_obs[$key] = $itensObservacao[$i];
        $i++;
    }
    
    //itens_fliped -> id no index 
    $itens_fliped_qtd = $itens_fliped; 
    $i=0;
    //Associa a Observação ao id do item    
    foreach ($itens_fliped as $key => $item_fliped){
        $itens_fliped_qtd[$key] = $itensQtd[$i];
        $i++;
    }
    
    //Ordena observacao/qtd com base no código do item(id)
    ksort($itens_fliped_obs);
    ksort($itens_fliped_qtd);
    
    //retorna os index da observação/qtd para incremetal
    $i=0;
    foreach ($itens_fliped_obs as $key => $obs){
        $itens_obs[$i] = $obs;   
        $i++;
    }
    $i=0;
    foreach ($itens_fliped_qtd as $key => $qtd){
        $itens_qtd[$i] = $qtd;
        $i++;
    }

    //Salva na Session valores Reordenados
    sort($itens);
    $_SESSION['carrinho'] = array_values($itens);

    $_SESSION['observacao'] = $itens_obs;
    $_SESSION['qtd'] = $itens_qtd;


} else {
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $_SESSION['observacao'] = array();
    $itens = $_SESSION['carrinho'];
    $itensObservacao = $_SESSION['observacao'];
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
    <div class="container-fluid row carrinho  ">
        <table class="tabela_itens table ">
            <thead>
                <tr id="cabecalhoTabela">
                    <th>Excluir</th>
                    <th>Produto</th>
                    <th id="precoUnitario">Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Quantidade</th>
                    <th id="deliveryTabela">Delivery</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $totalCarrinho = 0;
                    $i = 0;
                    $pedidoBalcao = 0;
                    foreach ($itens as $key => $item) : ?>
                    <tr id="idLinha<?= $i ?>" data-id="<?= $item['cod_cardapio'] ?>" class=<?= ($item['delivery'] == 1) ? "disponivel" : "danger" ?> >
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?= $i ?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?= $item['nome'] ?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?= $i ?>" data-preco="<?= $item['preco'] ?>"><strong>R$ <?= number_format($item['preco'], 2); ?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?= $i ?>"><strong>R$ <?=  number_format(($item['preco'] * $_SESSION['qtd'][$key]), 2); ?></strong></td>
                        <td class="quantidadeProdutoTabela">
                            <input class="quantidadeItemTabela" id="qtdUnidade<?= $i ?>" name="quantidade" type="text" value=<?= $_SESSION['qtd'][$key] ?> readonly="true">
                            <i id="adicionarUnidade" data-toggle="tooltip" title="Adicione 1." data-linha="<?= $i ?>" class="fas fa-cart-plus fa-lg btn iconeAdicionarProdutoTabela"></i>
                            <i id="removerUnidade" data-toggle="tooltip" title="Remove 1." data-linha="<?= $i ?>" class="fas fa-cart-arrow-down fa-lg btn iconeExcluirProdutoTabela"></i>
                        </td>
                        <td class="nomeProdutoDisponivel"><strong>
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
                <div class="legenda-carrinho">
                <br><p id="texto-legenda" class="danger"><i class="fas fa-exclamation-circle"></i> Delivery não disponível para itens em <b>Vermelho!</b></p>
                </div>
                
                <!-- Observações -->                  
                <div class="ladoDireito row" style="padding-left: 10px">
                        <table class="tabela_itens table">
                            
                            <?php
                            if($_SESSION['observacao'][$key] != ""){
                            // var_dump($_SESSION['observacao']);
                               echo "<strong><p style='padding-left:6px'>Observações</p></strong>";
                            }
                            ?>
                            <!-- <strong><p>Observações</p></strong> -->
                                <?php
                                $i = 0;
                                foreach ($itens as $key => $item) :

                                    $obs = $itens_obs[$key];
                                ?>               
                                
                                <div id="idLinhaObs<?= $i ?>" data-id="<?= $item['cod_cardapio'] ?>" class="ladoDireito row">    
                                    <?php
                                    if(!empty($obs)){ ?>
                                        <span data-linha="<?= $i ?>" style="padding-left: 22px; width: 200px; font-size: 13px; border:none !important"><b><?= $item['nome'] ?></b> : <?= $obs?></span>
                                    <?php 
                                    }?>
                                </div>
                                </div>
                                <?php
                                $i++;
                                endforeach;
                                ?>
                        </table>
                        </div>
                </div>
                
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

                /*Endereço inserido na Página Inicial*/
                if(isset($_SESSION['endereco']['postal_code'])){
                    $_SESSION['is_delivery_home'] = 1;
                    //unset($_SESSION['endereco']);
                }else if(!isset($_SESSION['is_delivery_home'])){//se setado mantem valor
                    $_SESSION['is_delivery_home'] = 0;
                }
                //unset($_SESSION['is_delivery_home']);//p/ test


                /*Endereço Cadastrado Selecionado*/
                if(isset($_SESSION['cod_endereco']) && !empty($_SESSION['cod_endereco'])){
                    $_SESSION['delivery']= 1;//delivery p/ endereço cadastrado

                    $codEnd = $_SESSION['cod_endereco'];
                    $endereco_cadastrado = $controlEndereco->select($codEnd, 1);
                    $endereco_cadastrado = $endereco_cadastrado[0];

                }else{
                    $_SESSION['delivery']=-1;
                    $endereco_cadastrado = 0;
                }


                $_SESSION['entrega_valida'] = 0;

                if (($_SESSION['is_delivery_home'] == 1)) {
                    //taxa de entrega calculada?
                    if (($_SESSION['delivery_price'] > 0) && ($_SESSION['is_delivery_home'])) {
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
                    
                    $destino_setted = 0;
                    //Endereço inserido na página inicial
                    if(isset($_SESSION['endereco']['postal_code'])){

                        $cep = $_SESSION['endereco']['postal_code'];
                        $rua = $_SESSION['endereco']['route'];
                        $numero = $_SESSION['endereco']['street_number'];
                        $bairro = $_SESSION['endereco']['sublocality_level_1'];
                        $complemento = $_SESSION['endereco']['complemento'];
                        $cidade = $_SESSION['endereco']['administrative_area_level_2'];
                        $referencia = $_SESSION['endereco']['referencia'];
                        //$uf = $_SESSION['endereco']['administrative_area_level_1'];
                        
                        $destino_setted = 1;

                    //Endereço Cadastrado e Selecionado
                    }else if($endereco_cadastrado){
                        
                        $cep = $endereco_cadastrado->getCep();
                        $rua = $endereco_cadastrado->getRua();
                        $numero = $endereco_cadastrado->getNumero();
                        $bairro = $endereco_cadastrado->getBairro();
                        $complemento = $endereco_cadastrado->getComplemento();
                        $cidade = $endereco_cadastrado->getCidade();
                        $referencia = $endereco_cadastrado->getReferencia();

                        //display em fechar pedido
                        $_SESSION['numero_entrega'] = $numero;
                        $_SESSION['rua_entrega'] = $rua;

                        $destino_setted = 1;
                    }

                    if($destino_setted){
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

                            $_SESSION['valor_entrega_minimo'] = $info_entrega->getValor_minimo();

                            //verifica se valor do pedido é suficiente para delivery
                            if($_SESSION['totalCarrinho'] >= $_SESSION['valor_entrega_minimo']){
                                $_SESSION['valor_entrega_valido'] = 1;
                            }else{
                                $_SESSION['valor_entrega_valido'] = 0;
                            }

                            $_SESSION['minimo_taxa_gratis'] = (float)$info_entrega->getMin_taxa_gratis();
                            
                            $_SESSION['delivery_price_calculado'] = (float) $info_entrega->getTaxa_entrega();

                            //verifica se entrega é grátis
                            if($_SESSION['totalCarrinho'] >= $_SESSION['minimo_taxa_gratis']){
                                $_SESSION['delivery_free'] = 1;
                                $_SESSION['delivery_price'] = (float) 0;
                            }else{

                                $_SESSION['delivery_price'] = (float) $_SESSION['delivery_price_calculado'];
                                
                                $_SESSION['totalCorrigido'] += (float) $_SESSION['delivery_price_calculado'];
                            }

                            $estimativa_tempo = $info_entrega->getTempo();
                            $_SESSION['delivery_time'] = floor($estimativa_tempo);//em minutos


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
                            //Endereço inválido p/ distância da entrega
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
                        echo "<br><span id='infoDeliverySemEndereco'><i class='fas fa-info-circle'></i>&nbsp;Ou selecione um Endereço cadastrado, ao Finalizar o Pedido.</span>";
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
                    $_SESSION['is_delivery_home'] = 0;
                    
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
                    echo "<br><span><i class='fas fa-info-circle'></i>&nbsp;Ou selecione um Endereço cadastrado ao Finalizar o Pedido.</span>";
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
                    echo "<div class='botaoCupom'>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <div class='form-inline'>                            
                            <input class='form-control' type='text' name='codigocupom' id='codigocupom'>
                            <a class='botaoAdicionarCupom' onclick='adicionarCupom()'><button id='adicionarCupom' class='btn btn-danger'>Adicionar <i class='fa fa-ticket-alt fa-adjust'></i></button></a>    
                        </div>
                    </div>";
                } else {
                    echo "<div class='botaoCupom'>
                        <strong><p>Adicionar Cupom</p></strong> 
                        <div class='form-inline'>
                            <input class='form-control' type='text' name='codigocupomrem' id='codigocupomrem' disabled>
                            <a class='botaoAdicionarCupom' onclick='removerCupom()'><button id='removerCupom' class='btn btn-danger'>Remover Cupom<i class='fas fa-trash-alt fa-adjust'></i></button></a> 
                        </div>  
                    </div>";
                }
                ?>
                
                <div class="forma-pgt row">
                    <div class=" select-formapgt col-xs-12 col-sm-6 col-md-8 col-lg-10">
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
                if($_SESSION['entrega_valida'] && $_SESSION['is_delivery_home']){
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
                        <a class='botaoCarrinhoEnviar' href='../home/controler/validaPedido.php' onclick='observacaoSession()'><button id='finalizar' class='btn'>Finalizar Pedido <i class='far fa-envelope fa-adjust'></i></button></a>
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
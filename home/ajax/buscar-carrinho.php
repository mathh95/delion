<?php
// session_start();
if (!isset($_SESSION)){
    session_start();
  }

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";

include_once "../../admin/controler/controlFormaPgt.php";

include_once "../../admin/model/formaPgt.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
$_SESSION['delivery']=-1;
$_SESSION['formaPagamento']='';
$controlFormaPgt = new controlerFormaPgt($_SG['link']);
$formasPgt = $controlFormaPgt->selectAll();


if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $itens = $_SESSION['carrinho'];
    foreach ($_SESSION['qtd'] as $key => $value) {
        $_SESSION['qtd'][$key] = 1;
    }
}else{
    $_SESSION['carrinho'] = array();
    $_SESSION['qtd'] = array();
    $itens = $_SESSION['carrinho'];
}
if(count($itens) > 0){
    
    $itens = $cardapio->buscarVariosId($itens);
?>
        <script type="text/javascript" src="js/buscar-delivery.js"></script>
        <script type="text/javascript" src="js/buscar-carrinho.js"></script>
        <h1 class="text-center">Pedido</h1>
        <?php //print_r($_SESSION['qtd']); ?>
        <?php //print_r($_SESSION['carrinho']); ?>
        <div class="carrinho row">
            <table class="tabela_itens table table-hover table-responsive table-condensed">
                <thead>
                    <tr id="cabecalhoTabela" >
                        <th>Excluir</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Quantidade</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
        
                <?php $total = 0; 
                $i = 0;
                $pedidoBalcao=0;
                foreach($itens as $item): ?>
                    <tr id="idLinha<?=$i?>" data-id="<?=$item['cod_cardapio']?>">
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?=$i?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?=$item['nome']?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?=$i?>" data-preco="<?=$item['preco']?>"><strong>R$ <?=number_format($item['preco'], 2);?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?=$i?>"><strong>R$ <?=number_format($item['preco'], 2);?></strong></td>
                        <td class="quantidadeProdutoTabela">
                            <input class="quantidadeItemTabela" id="qtdUnidade<?=$i?>" name="quantidade" type="text" value=1 readonly="true">
                            <i id="adicionarUnidade" data-toggle="tooltip" title="Adicione 1." data-linha="<?=$i?>" class="fas fa-cart-plus fa-lg btn iconeAdicionarProdutoTabela"></i>
                            <i id="removerUnidade" data-toggle="tooltip" title="Remove 1." data-linha="<?=$i?>" class="fas fa-cart-arrow-down fa-lg btn iconeExcluirProdutoTabela"></i>
                        </td>
                        <td class="nomeProdutoTabela"><strong><?php if($item['delivery'] == 1){
                            echo "Disponível";
                            }else{
                            echo "Não disponível";
                            $pedidoBalcao=$pedidoBalcao + 1;
                            }    ?></strong> </td>
                    </tr>
            <?php $i++; $total += $item['preco']; endforeach;
            $_SESSION['totalCarrinho'] = $total;
            $_SESSION['pedidoBalcao']=$pedidoBalcao;
            ?>
        
        </tbody>
        </table>
        </div>
        <div class="rodapeCarrinho row">
        <div class='ladoEsquerdo'>
            <strong><p>Forma de Pagamento</p></strong>
                <div class="input-group">
                    <select name="formaPagamento" id="formaPagamento" class="form-control">
                        <option value="0">Dinheiro</option>
                        <?php
                                foreach($formasPgt as $formaPgt) {
                                    if($formaPgt->getFlag_ativo() == 1){
                                        echo "<option value ='".$formaPgt->getCod_formaPgt()."'>".$formaPgt->getTipoFormaPgt()."</option>";
                                    }
                                }
                        ?>
                    </select>
                </div>

                <?php

        echo "<strong><p>Entrega</p></strong>
        <div class='btn-group btn-group-toggle' data-toggle='buttons'>
        <label class='btn btn-danger' id='delivery' onclick='tipoPedido(1)'>
        <input type='radio' name='delivery'  autocomplete='off'> Delivery&nbsp;<i class='fas fa-shipping-fast'></i></label>
        <label class='btn btn-danger active'  id='balcao' onclick='tipoPedido(-1)'>
        <input type='radio' name='balcao' autocomplete='off'> Balcão&nbsp;<i class='fas fa-store'></i>
        </label>
        </div>
        
        <div>
            <strong><p>Adicionar Cupom</p></strong> 
            <input type='text' name='codigocupom' id='codigocupom'>
            <a class='botaoVerificarCupom' onclick='verificarCupom()'><button id='verificarCupom' class='btn btn-danger'>Adicionar <i class='fa fa-ticket-alt fa-adjust'></i></button></a>    
        </div>
        </div>                    
                    <div class='ladoDireito row'>
                    <p id='total'>Subtotal: R$ ".number_format($_SESSION['totalCarrinho'], 2)."</p>
                    <p id='entrega'>Taxa de Entrega: R$ 0.00</p>
                    <p id='desconto'>Desconto: R$ ".number_format($_SESSION['valorcupom'],2)."</p> 
                    <strong><p id='subtotalDesc'> Total: R$ ".number_format($_SESSION['totalComDesconto'],2)."</p></strong>
                    
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
}else{
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

<!-- <script>

    

</script> -->
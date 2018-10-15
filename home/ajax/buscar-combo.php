<?php
session_start();

ini_set('display_errors', true);

date_default_timezone_set('America/Sao_Paulo');


include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCombo.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

// require_once '../ajax/enviarEmailPedido.php';

$itens = array();
$cardapio = new controlerCardapio(conecta());
// $pedido = new enviarEmailPedido;
if(isset($_GET['delivery']) && !empty($_GET['delivery'])){
    $_SESSION['delivery']=$_GET['delivery'];
}else{
    $_SESSION['delivery']=-1;
}


if(isset($_SESSION['combo']) && !empty($_SESSION['combo'])){
    $itens = $_SESSION['combo'];
    foreach ($_SESSION['qtdCombo'] as $key => $value) {
        $_SESSION['qtdCombo'][$key] = 1;
    }
}else{
    $_SESSION['combo'] = array();
    $_SESSION['qtdCombo'] = array();
    $itens = $_SESSION['combo'];
}
if(count($itens) > 0){
    
    $itens = $cardapio->buscarVariosId($itens);
?>
        <script type="text/javascript" src="js/buscar-delivery-combo.js"></script>
        <script type="text/javascript" src="js/buscar-combo.js"></script>
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
                foreach($itens as $item): 
                    $perc = $item['desconto'] / 100;
                    $perc = $item['preco'] * $perc;
                    $total += $item['preco'] - $perc;?>
                    <tr id="idLinha<?=$i?>" data-id="<?=$item['cod_cardapio']?>">
                        <td><i id="removeItem" data-toggle="tooltip" title="Remover item!" data-linha="<?=$i?>" class="fas fa-trash-alt btn iconeRemoverProdutoTabela"></i></td>
                        <td class="text-uppercase nomeProdutoTabela"><strong><?=$item['nome']?></strong></td>
                        <td class="precoProdutoTabela" id="preco<?=$i?>" data-desconto="<?=$item['desconto']?>" data-preco="<?=$item['preco']?>"><strong>R$ <?=number_format($item['preco'], 2);?></strong></td>
                        <td class="subtotalProdutoTabela" id="subtotal<?=$i?>"><strong>R$ <?=number_format($item['preco'] - $perc, 2);?></strong></td>
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